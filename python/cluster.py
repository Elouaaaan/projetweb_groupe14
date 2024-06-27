import os
import sys

import pandas as pd
import numpy as np
import joblib

df = pd.read_json(sys.argv[1])
    
    df['tronc_section'] = np.pi * (df['tronc_diam'] / 2) ** 2
    
    preprocessor_filename = os.path.join(dirname, 'models/preprocessor.pkl')
    preprocessor = joblib.load(preprocessor_filename)

    X = preprocessor.transform(df)
    
    kmeans_2_clusters_filename = os.path.join(dirname, 'models/kmeans_2_clusters.pkl')
    kmeans_3_clusters_filename = os.path.join(dirname, 'models/kmeans_3_clusters.pkl')
    db_filename = os.path.join(dirname, 'models/dbscan.pkl')
    
    models = {
        'kmeans_2_clusters': joblib.load(kmeans_2_clusters_filename),
        'kmeans_3_clusters': joblib.load(kmeans_3_clusters_filename),
        'db': joblib.load(db_filename)
    }
    
    match sys.argv[2]:
        case '1':
            y_pred = models['kmeans_2_clusters'].predict(X)
        case '2':
            y_pred = models['kmeans_3_clusters'].predict(X)
        case '3':
            y_pred = models['db'].fit_predict(X)
            
    df['cluster'] = y_pred
    result = df.to_json(orient='records')
    print(result)
