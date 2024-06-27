fetch('api/request.php/clusters/?cluster=1', {
    method: 'GET'
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