let controller = null;

function get_clusters(clusterId) {
    if (controller) {
        controller.abort();
    }

    controller = new AbortController();

    fetch(`api/request.php/clusters/?cluster=${clusterId}`, {
        method: 'GET',
        signal: controller.signal
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Request failed with status: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

document.getElementsByName('choix-clusters').forEach((radio) => {
    radio.addEventListener('click', (event) => {
        console.log(event.target.value);
        get_clusters(event.target.value);
    });
});