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

async function get_secteur() {
    try {
        const url = `api/request.php/secteur/`;
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
    const secteurs = await get_secteur(selectedSectorId)

    console.log(secteurs)
});