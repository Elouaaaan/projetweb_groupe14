import os
import sys

import pandas as pd
import numpy as np
import joblib

print(sys.argv)
dirname = os.path.dirname(os.path.abspath(__file__))

df = pd.read_json(sys.argv[1])
df['tronc_section'] = np.pi * (df['tronc_diam'] / 2) ** 2

# Handling different model choices based on sys.argv[2]
model_path = None
model_choice = sys.argv[2]

if model_choice == '1':
    model_path = os.path.join(dirname, 'models/kmeans_2_clusters.pkl')
elif model_choice == '2':
    model_path = os.path.join(dirname, 'models/kmeans_3_clusters.pkl')
elif model_choice == '3':
    model_path = os.path.join(dirname, 'models/dbscan.pkl')
else:
    raise ValueError("Invalid model choice. Please choose from '1', '2', or '3'.")

# Load preprocessor and predict clusters
preprocessor = joblib.load(os.path.join(dirname, 'models/preprocessor.pkl'))
X = preprocessor.transform(df)
model = joblib.load(model_path)
y_pred = model.predict(X)

df['cluster'] = y_pred
result = df.to_json(orient='records')
print(result)
