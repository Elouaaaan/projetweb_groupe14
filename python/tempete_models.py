import pandas as pd
from sklearn.ensemble import RandomForestClassifier
from sklearn.preprocessing import StandardScaler, OneHotEncoder, OrdinalEncoder
from sklearn.model_selection import train_test_split
import joblib
import json
import os
import sys
from imblearn.over_sampling import SMOTE

dirname = os.path.dirname(os.path.abspath(__file__))
numerical_features = ['haut_tot', 'haut_tronc', 'tronc_diam', 'age_estim', 'nbr_diag']
categorical_features = ['quartier', 'stadedev', 'port', 'pied', 'situation', 'nomtech', 'villeca', 'feuillage']
boolean_features = ['revetement', 'remarquable']
target = 'arb_etat'


data_path = sys.argv[1]
with open(data_path, 'r') as json_file:
    data = json.load(json_file)

if isinstance(data, dict):
    data = [data]
    
df = pd.read_json(json.dumps(data))

print(df.head())


# X = df.drop(columns=target)
# y = df[target]

# X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# scaler = StandardScaler()
# scaler.fit(X[numerical_features])

# onehot_encoder = OneHotEncoder(drop='first', sparse_output=False)
# onehot_encoder.fit(X[categorical_features])

# categories = [['Non', 'Oui'] for _ in boolean_features]
# ordinal_encoder = OrdinalEncoder(categories=categories, dtype=int)
# ordinal_encoder.fit(X[boolean_features])

# X_train_scaled_numerical = scaler.transform(X_train[numerical_features])
# X_train_scaled_numerical_df = pd.DataFrame(X_train_scaled_numerical, columns=numerical_features)

# X_test_scaled_numerical = scaler.transform(X_test[numerical_features])
# X_test_scaled_numerical_df = pd.DataFrame(X_test_scaled_numerical, columns=numerical_features)

# X_train_encoded_categorical = onehot_encoder.transform(X_train[categorical_features])
# X_train_encoded_categorical_df = pd.DataFrame(X_train_encoded_categorical, columns=onehot_encoder.get_feature_names_out(categorical_features))

# X_test_encoded_categorical = onehot_encoder.transform(X_test[categorical_features])
# X_test_encoded_categorical_df = pd.DataFrame(X_test_encoded_categorical, columns=onehot_encoder.get_feature_names_out(categorical_features))

# X_train_encoded_boolean = ordinal_encoder.transform(X_train[boolean_features])    
# X_train_encoded_boolean_df = pd.DataFrame(X_train_encoded_boolean, columns=boolean_features)

# X_test_encoded_boolean = ordinal_encoder.transform(X_test[boolean_features])
# X_test_encoded_boolean_df = pd.DataFrame(X_test_encoded_boolean, columns=boolean_features)

# X_train_scaled = scaler.fit_transform(X_train)
# X_test_scaled = scaler.transform(X_test)

# onehot_encoder.fit(X_train)
# ordinal_encoder.fit(X_train)

# X_train_onehot = onehot_encoder.transform(X_train)
# X_test_onehot = onehot_encoder.transform(X_test)

# X_train_ordinal = ordinal_encoder.transform(X_train)
# X_test_ordinal = ordinal_encoder.transform(X_test)

# X_train = pd.concat([X_train_scaled_numerical_df, X_train_encoded_categorical_df, X_train_encoded_boolean_df], axis=1)
# X_test = pd.concat([X_test_scaled_numerical_df, X_test_encoded_categorical_df, X_test_encoded_boolean_df], axis=1)

# y_train = y_train.apply(lambda x: 1 if x == 'Essouché' else 0).astype(int)
# y_test = y_test.apply(lambda x: 1 if x == 'Essouché' else 0).astype(int)

# sm = SMOTE(random_state=42, sampling_strategy=0.25)

# X_train, y_train = sm.fit_resample(X_train, y_train)


# model = RandomForestClassifier(**{'bootstrap': False, 'max_depth': 30, 'max_features': 'sqrt', 'min_samples_leaf': 1, 'min_samples_split': 5, 'n_estimators': 200})
# model.fit(X_train_scaled, y_train)

# joblib.dump(scaler, 'models/tempete_standard_scaler.pkl')
# joblib.dump(onehot_encoder, 'models/tempete_one_hot_encoder.pkl')
# joblib.dump(ordinal_encoder, 'models/tempete_ordinal_encoder.pkl')
# joblib.dump(model, 'models/tempete_random_forest.pkl')

# print("Models and encoders have been saved successfully.")
