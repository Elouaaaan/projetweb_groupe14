let currentRequest = null;

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
    if (currentRequest) {
      currentRequest.abort();
      console.log(currentRequest);
    }
    const url = `api/request.php/arbre/?column=${column}&reverse=${reverse}&per_page=${per_page}&page=${page}&search=${search}`;
    const controller = new AbortController();
    const signal = controller.signal;
    currentRequest = controller;
    const response = await fetch(url, {
      method: 'GET',
      signal: signal
    });
    if (!response.ok) {
      throw new Error('Request failed with status:', response.status);
    }
    return await response.json();
  } catch (error) {
    console.error('Error:', error);
  }
}

let reverse = false;
let column = 'id_arbre';
let per_page = 50;
let page = 1;
let search = '';
let columns = ['longitude', 'latitude', 'quartier', 'secteur', 'haut_tot', 'haut_tronc', 'tronc_diam', 'arb_etat', 'stadedev', 'pied', 'port', 'situation', 'revetement', 'nbr_diag', 'nomtech', 'villeca', 'feuillage', 'remarquable']
let column_visible = [true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true];


function update_arbres() {
  get_arbres(column, reverse, per_page, page, search)
    .then(data => {
      if (currentRequest === null) {
        return;
      }
      show_arbres(data);
    })
    .catch(error => {
      console.error('Error:', error);
    });
}

document.getElementById('search').addEventListener('input', (event) => {
  search = event.target.value;
  update_arbres();
});

function show_arbres(arbre_data) {
  const table = document.querySelector('#tableau tbody');
  table.innerHTML = '';
  arbre_data.forEach(arbre => {
    const row = document.createElement('tr');
    columns.forEach((column, index) => {
      const cell = document.createElement('td');
      cell.textContent = arbre[column];
      row.appendChild(cell);
      if (!column_visible[index]) {
        cell.style.display = 'none';
      }
    });
    table.appendChild(row);
  });
}


document.querySelectorAll('.sort_asc').forEach(button => {
  button.addEventListener('click', (event) => {
    const parentDiv = event.target.parentNode.parentNode;
    let new_column = parentDiv.id;
    if (new_column === column && reverse === false) {
      column = 'id_arbre';
    } else {
      column = new_column;
    }
    reverse = false;
    update_arbres();
  });
});

document.querySelectorAll('.sort_desc').forEach(button => {
  button.addEventListener('click', (event) => {
    const parentDiv = event.target.parentNode.parentNode;
    let new_column = parentDiv.id;
    if (new_column === column && reverse === true) {
      column = 'id_arbre';
      reverse = false;
    } else {
      column = new_column;
      reverse = true;
    }
    update_arbres();
  });
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
    column_visible[colIndex] = this.checked;
  });
});

// si la page est rechargée, les colonnes sont affichées
document.querySelectorAll('.column-toggle').forEach(checkbox => {
  var colIndex = parseInt(checkbox.getAttribute('data-col-index'), 10);
  toggleColumn(colIndex, checkbox.checked);
});