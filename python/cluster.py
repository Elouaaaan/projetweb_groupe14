import os
import sys

import pandas as pd
import numpy as np
import joblib

dirname = os.path.dirname(os.path.abspath(__file__))

df = pd.read_json(sys.argv[1])
df['tronc_section'] = np.pi * (df['tronc_diam'] / 2) ** 2
    
match sys.argv[2]:
    case '1':
        model_path = os.path.join(dirname, 'models/kmeans_2_clusters.pkl')
    case '2':
        model_path = os.path.join(dirname, 'models/kmeans_3_clusters.pkl')
    case '3':
        model_path = os.path.join(dirname, 'models/dbscan.pkl')

X = joblib.load(os.path.join(dirname, 'models/preprocessor.pkl')).transform(df)
y_pred = joblib.load(model_path).predict(X)
            
df['cluster'] = y_pred
result = df.to_json(orient='records')
print(result)
