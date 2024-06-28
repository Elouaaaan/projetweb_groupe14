import os
import sys
import json
import pandas as pd
import joblib

from sklearn.model_selection import train_test_split
from sklearn.preprocessing import StandardScaler, OneHotEncoder

from sklearn.linear_model import Ridge
from sklearn.svm import SVR
from sklearn.ensemble import RandomForestRegressor


features = ['haut_tot', 'haut_tronc', 'tronc_diam', 'stadedev', 'nomtech']

numerical_features = ['haut_tot', 'haut_tronc', 'tronc_diam']
categorical_features = ['stadedev', 'nomtech']
target = 'age_estim'

dirname = os.path.dirname(os.path.abspath(__file__))

data_path = sys.argv[1]
with open(data_path, 'r') as json_file:
    data = json.load(json_file)

json_string = json.dumps(data)

df = pd.read_json(json_string)

X = df[features]
y = df[target]

X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

test_data = X_test.copy()

scaler = StandardScaler()
scaler.fit(X[numerical_features])

onehot_encoder = OneHotEncoder(drop='first', sparse_output=False)
onehot_encoder.fit(X[categorical_features])

X_train_scaled_numerical = scaler.transform(X_train[numerical_features])
X_train_scaled_numerical_df = pd.DataFrame(X_train_scaled_numerical, columns=numerical_features)

X_test_scaled_numerical = scaler.transform(X_test[numerical_features])
X_test_scaled_numerical_df = pd.DataFrame(X_test_scaled_numerical, columns=numerical_features)

X_train_encoded_categorical = onehot_encoder.transform(X_train[categorical_features])
X_train_encoded_categorical_df = pd.DataFrame(X_train_encoded_categorical, columns=onehot_encoder.get_feature_names_out(categorical_features))

X_test_encoded_categorical = onehot_encoder.transform(X_test[categorical_features])
X_test_encoded_categorical_df = pd.DataFrame(X_test_encoded_categorical, columns=onehot_encoder.get_feature_names_out(categorical_features))

X_train = pd.concat([X_train_scaled_numerical_df, X_train_encoded_categorical_df], axis=1)
X_test = pd.concat([X_test_scaled_numerical_df, X_test_encoded_categorical_df], axis=1)

models = {
    'ridge_model': Ridge(),
    'svr_model_linear': SVR(kernel='linear'),
    'svr_model_rbf': SVR(kernel='rbf'),
    'random_forest': RandomForestRegressor(**{'max_depth': 20, 'min_samples_leaf': 1, 'min_samples_split': 5, 'n_estimators': 200})
}

for model_name, model in models.items():
    model.fit(X_train, y_train)
    
    dirname = os.path.dirname(os.path.abspath(__file__))
    joblib.dump(model, os.path.join(dirname, f'models/{model_name}.pkl'))