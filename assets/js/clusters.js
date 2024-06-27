let controller = null;
const map = L.map('map').setView([51.505, -0.09], 13);

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
        })
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
    cluster_data.forEach(cluster => {
        const { longitude, latitude, clusterNb } = cluster;
        const marker = L.marker([latitude, longitude]).addTo(map);
        marker.setIcon(getClusterIcon(clusterNb));
    });
}

function getClusterIcon(cluster) {
    const clusterColors = {
        0: 'red',
        1: 'blue',
        2: 'green',
    };

    const color = clusterColors[cluster];

    const icon = L.divIcon({
        className: 'cluster-icon',
        html: `<div style="background-color: ${color};"></div>`,
        iconSize: [25, 25]
    });

    return icon;
}
