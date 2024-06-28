import os
import sys
import json
import pandas as pd
import numpy as np
import joblib

dirname = os.path.dirname(os.path.abspath(__file__))

data_path = sys.argv[1]
with open(data_path, 'r') as json_file:
    data = json.load(json_file)

json_string = json.dumps(data)

df = pd.read_json(json_string)

        
numerical_features = ['haut_tot', 'haut_tronc', 'tronc_diam']
categorical_features = ['stadedev', 'nomtech']
        
scaler_filename = os.path.join(dirname, 'models/age_scaler.pkl')
scaler = joblib.load(scaler_filename)
scaled_numerical = scaler.transform(df[numerical_features])
scaled_numerical_df = pd.DataFrame(scaled_numerical, columns=numerical_features)
    
categorical_encoder_filename = os.path.join(dirname, 'models/age_onehot_encoder.pkl')
categorical_encoder = joblib.load(categorical_encoder_filename)
encoded_categorical = categorical_encoder.transform(df[categorical_features])
encoded_categorial_df = pd.DataFrame(encoded_categorical, columns=categorical_encoder.get_feature_names_out(categorical_features))

models = {
    'ridge_model': 'models/age_ridge.pkl',
    'svr_linear': 'models/age_svr_linear.pkl',
    'svr_rbf': 'models/age_svr_rbf.pkl',
    'random_forest': 'models/random_forest.pkl',
}


X = pd.concat([scaled_numerical_df, encoded_categorial_df], axis=1)
X = X[model.feature_names_in_]


for model_name, model_filename in models.items():
    model = joblib.load(model_filename)
    
    y_pred = model.predict(X)
    
    df[model_name] = y_pred
    

result = df.to_json(orient='records')
print(result)