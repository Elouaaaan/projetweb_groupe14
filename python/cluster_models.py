import pandas as pd
import numpy as np
import joblib
from sklearn.cluster import KMeans, DBSCAN
from sklearn.compose import ColumnTransformer
from sklearn.preprocessing import StandardScaler, OneHotEncoder
import mysql.connector

DB_CONNECTION = 'mysql'
DB_HOST = 'localhost'
DB_DATABASE = 'etu1114'
DB_USERNAME = 'etu1114'
DB_PASSWORD = 'ubxzbxlt'

mydb = mysql.connector.connect(
    host=DB_HOST,
    user=DB_USERNAME,
    password=DB_PASSWORD,
    database=DB_DATABASE
)

mycursor = mydb.cursor()
mycursor.execute("SELECT haut_tot, tronc_diam, port FROM arbre JOIN port USING(id_port)")
df = pd.DataFrame(mycursor.fetchall(), columns=['haut_tot', 'tronc_diam', 'port'])

df['tronc_section'] = np.pi * (df['tronc_diam'] / 2) ** 2
features = ['haut_tot', 'tronc_section', 'port']
X = df[features]

scaler = StandardScaler()
num_features = ['haut_tot', 'tronc_section']
encoder = OneHotEncoder()
cat_features = ['port']

preprocessor = ColumnTransformer(
    transformers=[
        ('num', scaler, num_features),
        ('cat', encoder, cat_features)
    ],
    sparse_threshold=0,
    remainder='passthrough'
)

# Fit and transform the data using the preprocessor
X_prep = preprocessor.fit_transform(X)

# Train the KMeans model with 2 clusters
kmeans_2_clusters = KMeans(n_clusters=2)
kmeans_2_clusters.fit(X_prep)

# Train the KMeans model with 3 clusters
kmeans_3_clusters = KMeans(n_clusters=3)
kmeans_3_clusters.fit(X_prep)

# Train the DBSCAN model
dbscan = DBSCAN(eps=0.65, min_samples=3)
dbscan.fit(X_prep)

# Save the models and preprocessor
joblib.dump(preprocessor, 'models/preprocessor.pkl')
joblib.dump(kmeans_2_clusters, 'models/kmeans_2_clusters.pkl')
joblib.dump(kmeans_3_clusters, 'models/kmeans_3_clusters.pkl')
joblib.dump(dbscan, 'models/dbscan.pkl')
