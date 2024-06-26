
async function get_quartier(id_secteur) {
    try {
        const url = `api/request.php/quartier/?id_secteur=${id_secteur}`;
        const response = await fetch(url, {
            method: 'GET'
        });
        if (!response.ok) {
            throw new Error('Request failed with status:', response.status);
        }
        return await response.json();
    }
    catch (error) {
        console.error('Error:', error);
    }
}

async function get_secteur(id_quartier) {
    try {
        const url = `api/request.php/secteur/?id_quartier=${id_quartier}`;
        const response = await fetch(url, {
            method: 'GET'
        });
        if (!response.ok) {
            throw new Error('Request failed with status:', response.status);
        }
        return await response.json();
    }
    catch (error) {
        console.error('Error:', error);
    }
}

document.querySelector('#quartier').addEventListener('change', async function () {
    const selectedSectorId = this.value;
    const secteurs = await get_secteur(selectedSectorId);

    // Hide options that are not in the secteur JSON
    const selectElement = document.querySelector('#secteur');
    const options = selectElement.options;
    for (let i = 1; i < options.length; i++) {
        const option = options[i];
        if (!secteurs.some(secteur => secteur.id_secteur === option.value)) {
            option.style.display = 'none';
        } else {
            option.style.display = 'block';
        }
    }

    if (secteurs.length === 1) {
        selectElement.value = secteurs[1].id_secteur;
    }
});