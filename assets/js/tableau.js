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
async function get_arbres(column = 'id_arbre', reverse = false, per_page = 50, page = 1, search = '') {
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

get_arbres('id_arbre', false, 10, 1, 'en place')
  .then(data => {
    console.log(data);
  })
  .catch(error => {
    console.error('Error:', error);
  });


function toggleColumn(colIndex, isVisible) {
  // afficher/masquer la colonne basée sur colIndex et isVisible
  document.querySelectorAll(`#tableau tr > *:nth-child(${colIndex + 1})`).forEach(cell => {
    if (isVisible) {
      cell.style.display = '';
    } else {
      cell.style.display = 'none';
    }
  });
}

// Correction du gestionnaire d'événements
document.querySelectorAll('.column-toggle').forEach(checkbox => {
  checkbox.addEventListener('change', function () {
    // Utiliser l'attribut data-col-index pour déterminer l'index de la colonne
    var colIndex = parseInt(this.getAttribute('data-col-index'), 10);
    // Afficher/masquer la colonne
    toggleColumn(colIndex, this.checked);
  });
});

// si la page est rechargée, les colonnes sont affichées
document.querySelectorAll('.column-toggle').forEach(checkbox => {
  var colIndex = parseInt(checkbox.getAttribute('data-col-index'), 10);
  toggleColumn(colIndex, checkbox.checked);
});

document.getElementById('search').addEventListener('keypress', () => {
  var search = this.value;
  get_arbres('id_arbre', false, 10, 1, search)
    .then(data => {
      console.log(data);
    })
    .catch(error => {
      console.error('Error:', error);
    });
});