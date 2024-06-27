
fetch('api/request.php/clusters')
    .then(response => {
        if (!response.ok) {
            throw new Error('Request failed with status: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        show_clusters(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });