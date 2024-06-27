let controller = null;
const map = L.map('map').setView([49.84050020512298, 3.2932636093638927], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 21,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

const markers = L.markerClusterGroup({
    maxClusterRadius: 40, // Smaller clusters
    iconCreateFunction: function (cluster) {
        const childCount = cluster.getChildCount();
        let size = 'small';
        if (childCount > 10) {
            size = 'medium';
        }
        if (childCount > 100) {
            size = 'large';
        }
        return new L.DivIcon({
            html: '<div><span>' + childCount + '</span></div>',
            className: 'marker-cluster marker-cluster-' + size,
            iconSize: new L.Point(40, 40)
        });
    }
});

function get_clusters(clusterId) {
    if (controller) {
        controller.abort();
    }

    controller = new AbortController();

    return fetch(`api/request.php/clusters/?cluster=${clusterId}`, {
        method: 'GET',
        signal: controller.signal
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Request failed with status: ' + response.status);
            }
            return response.json();
        });
}

document.getElementsByName('choix-clusters').forEach((radio) => {
    radio.addEventListener('click', (event) => {
        get_clusters(event.target.value)
            .then(data => {
                if (!controller.signal.aborted) {
                    show_clusters(data);
                }
            })
            .catch(error => {
                if (error.name !== 'AbortError') {
                    console.error('Error:', error);
                }
            });
    });
});

function show_clusters(cluster_data) {
    markers.clearLayers();

    cluster_data.forEach(cluster_tree => {
        const { longitude, latitude, cluster, nomtech, stadedev, feuillage, haut_tot, tronc_diam, port } = cluster_tree;
        const marker = L.marker([latitude, longitude]);
        marker.setIcon(createMarkerIcon(cluster));

        marker.bindPopup(`
            <b>Hauteur de l'arbre:</b> ${haut_tot}cm<br>
            <b>Diameter du tronc:</b> ${tronc_diam}cm<br>
            <b>Espèce:</b> ${nomtech}<br>
            <b>Stade de développement:</b> ${stadedev}<br>
            <b>Type:</b> ${feuillage}<br>
            <b>Port:</b> ${port}<br>
        `);

        markers.addLayer(marker);
    });

    map.addLayer(markers);
}

function createMarkerIcon(cluster) {
    const clusterColors = [
        '#FF0000',
        '#1E90FF',
        '#32CD32',
        '#FFD700',
        '#FF69B4',
        '#8A2BE2',
        '#FF4500',
        '#2E8B57',
        '#8B4513',
        '#00CED1',
        '#9400D3',
        '#FF6347',
        '#4682B4',
        '#D2691E',
        '#00FF7F',
        '#DC143C',
        '#000080',
        '#ADFF2F',
        '#FF8C00',
        '#9932CC',
        '#8B0000',
        '#006400'
    ];

    const color = clusterColors[cluster + 1];

    return L.divIcon({
        className: 'marker-icon',
        html: `<div style="background-color: ${color}; width: 20px; height: 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">${cluster}</div>`
    });
}

get_clusters(1)
    .then(data => {
        show_clusters(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });