import sys
import pandas as pd
import numpy as np
import joblib
from sklearn.cluster import KMeans, DBSCAN
from sklearn.compose import ColumnTransformer
from sklearn.preprocessing import StandardScaler, OneHotEncoder


# df = pd.read_json(sys.argv[1])

# df['tronc_section'] = np.pi * (df['tronc_diam'] / 2) ** 2
# features = ['haut_tot', 'tronc_section', 'port']
# X = df[features]

# scaler = StandardScaler()
# num_features = ['haut_tot', 'tronc_section']
# encoder = OneHotEncoder()
# cat_features = ['port']

# preprocessor = ColumnTransformer(
#     transformers=[
#         ('num', scaler, num_features),
#         ('cat', encoder, cat_features)
#     ],
#     sparse_threshold=0,
#     remainder='passthrough'
# )

# # Fit and transform the data using the preprocessor
# X_prep = preprocessor.fit_transform(X)

# # Train the KMeans model with 2 clusters
# kmeans_2_clusters = KMeans(n_clusters=2)
# kmeans_2_clusters.fit(X_prep)

# # Train the KMeans model with 3 clusters
# kmeans_3_clusters = KMeans(n_clusters=3)
# kmeans_3_clusters.fit(X_prep)

# # Train the DBSCAN model
# dbscan = DBSCAN(eps=0.65, min_samples=3)
# dbscan.fit(X_prep)

# Get the current path
import os
current_path = os.getcwd()
print("Current path:", current_path)
print(os.path.dirname(os.path.abspath(__file__)))

# # Save the models and preprocessor
# joblib.dump(preprocessor, '../python/models/preprocessor.pkl')
# joblib.dump(kmeans_2_clusters, '../python/models/kmeans_2_clusters.pkl')
# joblib.dump(kmeans_3_clusters, '../python/models/kmeans_3_clusters.pkl')
# joblib.dump(dbscan, '../python/models/dbscan.pkl')
