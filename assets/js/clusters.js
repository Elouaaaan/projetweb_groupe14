let controller = null;
const map = L.map('map').setView([49.84050020512298, 3.2932636093638927], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

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
    cluster_data.forEach(cluster_tree => {
        const { longitude, latitude, cluster } = cluster_tree;
        const marker = L.marker([latitude, longitude]).addTo(map);
        marker.setIcon(createMarkerIcon(cluster_tree));

        marker.bindPopup(`
                    <b>Cluster:</b> ${cluster_tree.cluster}<br>
                    <b>Height:</b> ${cluster_tree.haut_tot}m<br>
                    <b>Diameter:</b> ${cluster_tree.tronc_diam}cm
                `);
    });
}

function createMarkerIcon(cluster_tree) {
    const { cluster } = cluster_tree;

    const clusterColors = {
        0: 'red',
        1: 'blue',
        2: 'green'
    };

    const color = clusterColors[cluster];

    return L.divIcon({
        className: 'marker-icon',
        html: `<div style="background-color: ${color}; width: 25px; height: 25px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">${cluster}</div>`
    });
}