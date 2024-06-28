import os
import sys
import json
import pandas as pd
import joblib

from selenium import webdriver
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from webdriver_manager.chrome import ChromeDriverManager
from bs4 import BeautifulSoup

from math import sqrt, exp

import requests

coordinate_features = ['latitude', 'longitude']
numerical_features = ['haut_tot', 'haut_tronc', 'tronc_diam', 'age_estim', 'nbr_diag']
categorical_features = ['quartier', 'stadedev', 'port', 'pied', 'situation', 'nomtech', 'villeca', 'feuillage']
boolean_features = ['revetement', 'remarquable']

target = 'fk_arb_etat'


def predict_data(file_path: str, dirname: str) -> None:
    """
    Predicts data using a trained machine learning model.

    Args:
        file_path (str): The path to the JSON file containing the data to be predicted.
        dirname (str): The directory name where the project is stored.

    Returns:
        DataFrame: The original DataFrame with an additional column 'proba_deracinage' containing the predicted probabilities.
    """
    filename = os.path.join(dirname, file_path)
    df = pd.read_json(filename, orient='records')
        
    # Scaling numerical features
    scaler_filename = os.path.join(dirname, 'models/standart_scaler.pkl')
    numerical_scaler = joblib.load(scaler_filename)
    scaled_numerical = numerical_scaler.transform(df[numerical_features])
    scaled_numerical_df = pd.DataFrame(scaled_numerical, columns=numerical_features)
    
    # Encoding categorical features
    categorical_encoder_filename = os.path.join(dirname, 'models/one_hot_encoder.pkl')
    categorical_encoder = joblib.load(categorical_encoder_filename)
    encoded_categorical = categorical_encoder.transform(df[categorical_features])
    encoded_categorial_df = pd.DataFrame(encoded_categorical, columns=categorical_encoder.get_feature_names_out(categorical_features))
    
    # Encoding boolean features
    boolean_encoder_filename = os.path.join(dirname, 'models/ordinal_encoder.pkl')
    boolean_encoder = joblib.load(boolean_encoder_filename)
    encoded_boolean = boolean_encoder.transform(df[boolean_features])
    encoded_boolean_df = pd.DataFrame(encoded_boolean, columns=boolean_features)
    
    # Concatenating all features
    X = pd.concat([scaled_numerical_df, encoded_categorial_df, encoded_boolean_df], axis=1)
    
    model_filename = os.path.join(dirname, 'models/random_forest.pkl')
    model = joblib.load(model_filename)
    
    X = X[model.feature_names_in_]    
    y_pred = model.predict(X)
    y_pred_proba = model.predict_proba(X)
    
    plot_data = pd.concat([df[coordinate_features], pd.Series(y_pred, name='prediction'), pd.Series(y_pred_proba[:, 1], name='proba')], axis=1)
        
    #print('Predictions:', y_pred)

    y_pred_proba = y_pred_proba[:, 1]
    df['proba_deracinage'] = y_pred_proba


    return df

def is_deracined(df, wind_speed) -> bool:
    # renvoie True si l'arbre est déraciné, False sinon
    resistance = get_resistance(df['haut_tot'], df['tronc_diam'])
    #k = (1 - df['proba_deracinage']) / (df['proba_deracinage'] * resistance) if df['proba_deracinage'] != 0 else 0

    k = 0.1 #compris entre 0.03 et 0.1

    frisk = exp(k * (wind_speed - resistance))
    proba = df['proba_deracinage'] * frisk
    
    return proba > 0.90


def get_today_wind_speed() -> float:

    # Configuration du service pour utiliser le ChromeDriver
    service = Service(ChromeDriverManager().install())

    # init navigateur
    driver = webdriver.Chrome(service=service)
    print("Navigateur ouvert")

    url = 'https://meteofrance.com/previsions-meteo-france/saint-quentin/02100'

    # ouvrir la page
    driver.get(url)

    # attendre que la vitesse du vent soit chargé
    try:
        WebDriverWait(driver, 5).until(
            EC.presence_of_element_located((By.CLASS_NAME, 'wind'))
        )
        
        page_content = driver.page_source
        soup = BeautifulSoup(page_content, 'html.parser')
        wind_div = soup.find('div', class_='wind')
        wind_speed = wind_div.get_text(strip=True) if wind_div else 'Non trouvé'
    finally:
        driver.quit()
        wind_speed = wind_speed[:-4]
        return float(wind_speed)
    
def get_some_day_wind_speed(day: str) -> float:
    # day format: '2024/05/01'
    url = "https://www.historique-meteo.net/france/picardie/saint-quentin/" + day + "/"

    response = requests.get(url)
    response.raise_for_status()  # Raise an error for bad status codes

    # Parse the web page content
    soup = BeautifulSoup(response.content, 'html.parser')
    
    # Locate the table with weather data
    table = soup.find('table', class_='table')
    
    if not table:
        return None
    
    rows = table.find_all('tr')
    
    for row in rows:
        columns = row.find_all('td')
        if len(columns) > 1 and 'Vitesse du vent' in columns[0].text:
            wind_speed = columns[3].text.strip()
            wind_speed = wind_speed[:-4]
            return float(wind_speed)
    
    return None

def get_resistance(H,D):
    # H: hauteur de l'arbre
    # D: diametre de l'arbre
    # renvoie une vitesse de vent à partir de laquelle l'arbre est déraciné
    pi = 3.142
    rho = 1.225
    k1 = 2
    C = 5000

    resistance = sqrt((C*pi*D/100) / (2*rho*k1*H)) * 3.6

    return resistance


def get_percent_deracined(df):
    # df: DataFrame qui contient un seul arbre.
    # renvoie le pourcentage de chance que l'arbre soit déraciné sans tenir compte de la vitesse actuelle du vent
    return df['proba_deracinage']




        
if __name__ == '__main__':
    dirname = os.path.dirname(os.path.abspath(__file__))
    
    data_path = sys.argv[1]
    with open(data_path, 'r') as json_file:
        data = json.load(json_file)

    if isinstance(data, dict):
        data = [data]
    
        
    df = predict_data(json.dumps(data), dirname)
    
    
    result = df.to_json(orient='records')
    print(result)




   