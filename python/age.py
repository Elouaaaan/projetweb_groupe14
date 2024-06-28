import os
import sys
import json
import pandas as pd
import numpy as np
import joblib

features = ['haut_tot', 'haut_tronc', 'tronc_diam', 'fk_stadedev', 'fk_nomtech']

dirname = os.path.dirname(os.path.abspath(__file__))

data_path = sys.argv[1]
with open(data_path, 'r') as json_file:
    data = json.load(json_file)

json_string = json.dumps(data)

df = pd.read_json(json_string)
df['tronc_section'] = np.pi * (df['tronc_diam'] / 2) ** 2

        
numerical_features = df.select_dtypes(include=['int64', 'float64']).columns.tolist()
categorical_features = df.select_dtypes(include=['object']).columns.tolist()
        
scaler_filename = os.path.join(dirname, 'models/scaler.pkl')
scaler = joblib.load(scaler_filename)
scaled_numerical = scaler.transform(df[numerical_features])
scaled_numerical_df = pd.DataFrame(scaled_numerical, columns=numerical_features)
    
categorical_encoder_filename = os.path.join(dirname, 'models/onehot_encoder.pkl')
categorical_encoder = joblib.load(categorical_encoder_filename)
encoded_categorical = categorical_encoder.transform(df[categorical_features])
encoded_categorial_df = pd.DataFrame(encoded_categorical, columns=categorical_encoder.get_feature_names_out(categorical_features))

models = {
    'ridge_model': 'models/ridge.pkl',
}

model_filename = os.path.join(dirname, 'models/random_forest.pkl')
model = joblib.load(model_filename)

X = pd.concat([scaled_numerical_df, encoded_categorial_df], axis=1)
X = X[model.feature_names_in_]
    
y_pred = model.predict(X)

df['age'] = y_pred

result = df.to_json(orient='records')
print(result)