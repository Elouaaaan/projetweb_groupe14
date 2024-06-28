import os
import sys
import json

import pandas as pd
import numpy as np
import joblib

dirname = os.path.dirname(os.path.abspath(__file__))

print(dirname)

data_path = sys.argv[1]
with open(data_path, 'r') as json_file:
    data = json.load(json_file)

json_string = json.dumps(data)

df = pd.read_json(json_string)
df['tronc_section'] = np.pi * (df['tronc_diam'] / 2) ** 2

model_choice = sys.argv[2]

preprocessor = joblib.load(os.path.join(dirname, 'models/preprocessor.pkl'))
X = preprocessor.transform(df[['haut_tot', 'tronc_section', 'port']])


if model_choice == '1':
    model_path = os.path.join(dirname, 'models/kmeans_2_clusters.pkl')
    model = joblib.load(model_path)
    y_pred = model.predict(X)
elif model_choice == '2':
    model_path = os.path.join(dirname, 'models/kmeans_3_clusters.pkl')
    model = joblib.load(model_path)
    y_pred = model.predict(X)
elif model_choice == '3':
    model_path = os.path.join(dirname, 'models/dbscan.pkl')
    model = joblib.load(model_path)
    model.fit(X)
    y_pred = model.labels_
else:
    raise ValueError("Invalid model choice. Please choose from '1', '2', or '3'.")

df['cluster'] = y_pred
result = df.to_json(orient='records')
print(result)
