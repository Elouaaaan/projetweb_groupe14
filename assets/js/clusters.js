let controller = null;

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
        const { longitude, latitude } = cluster;
        console.log(latitude, longitude);
        const marker = L.marker([latitude, longitude]).addTo(map);
    });
}