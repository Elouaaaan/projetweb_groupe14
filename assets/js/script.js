/**
 * Retrieves a list of arbres (trees) from the API.
 * 
 * @param {string} column - The column to sort the results by. Default is 'id_arbre'.
 * @param {boolean} reverse - Whether to sort the results in reverse order. Default is false.
 * @param {number} per_page - The number of results to fetch per page. Default is 10.
 * @param {number} page - The page number to fetch. Default is 1.
 * @param {string} search - The search term to filter the results. Default is an empty string. Words in brackets are considered as a single search term.
 * @returns {Promise} - A promise that resolves to the JSON response from the API.
 */
async function get_arbres(column = 'id_arbre', reverse = false, per_page = 10, page = 1, search = '') {
    try {
        const url = `api/request.php/arbre/?column=${column}&reverse=${reverse}&per_page=${per_page}&page=${page}&search=${search}`;
        const response = await fetch(url, {
            method: 'GET'
        });
        if (!response.ok) {
            throw new Error('Request failed with status:', response.status);
        }
        return await response.json();
    } catch (error) {
        console.error('Error:', error);
    }
}

get_arbres('id_arbre', false, 10, 1, 'remplacé feuillu')
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });