let controller = null;
const map = L.map('map').setView([49.847066, 3.2874], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 21,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

const markers = L.markerClusterGroup({
    maxClusterRadius: 40,
    iconCreateFunction: cluster => {
        const childCount = cluster.getChildCount();
        const size = childCount > 100 ? 'large' : childCount > 10 ? 'medium' : 'small';
        return new L.DivIcon({
            html: `<div><span>${childCount}</span></div>`,
            className: `marker-cluster marker-cluster-${size}`,
            iconSize: new L.Point(40, 40)
        });
    }
});

const get_clusters = async (clusterId) => {
    if (controller) controller.abort();
    controller = new AbortController();
    try {
        const response = await fetch(`api/request.php/clusters/?cluster=${clusterId}`, {
            method: 'GET',
            signal: controller.signal
        });
        if (!response.ok) throw new Error(`Request failed with status: ${response.status}`);
        return await response.json();
    } catch (error) {
        if (error.name !== 'AbortError') console.error('Error:', error);
    }
};

document.querySelectorAll('[name="choix-clusters"]').forEach(radio => {
    radio.addEventListener('click', async (event) => {
        markers.clearLayers();
        const data = await get_clusters(event.target.value);
        if (data) show_clusters(data, event.target.value);
    });
});

const show_clusters = (cluster_data, cluster_nb) => {
    cluster_data.forEach(({ longitude, latitude, cluster, nomtech, stadedev, feuillage, haut_tot, tronc_diam, port }) => {
        const marker = L.marker([latitude, longitude], {
            icon: createMarkerIcon(cluster, cluster_nb)
        });

        marker.bindPopup(`
            <b>Espèce:</b> ${nomtech}<br>
            <b>Type:</b> ${feuillage}<br>
            <b>Port:</b> ${port}<br>
            <b>Stade de développement:</b> ${stadedev}<br>
            <b>Hauteur de l'arbre:</b> ${haut_tot}cm<br>
            <b>Diameter du tronc:</b> ${tronc_diam}cm<br>
        `);

        marker.on('mouseover', () => marker.openPopup());
        marker.on('mouseout', () => marker.closePopup());

        markers.addLayer(marker);
    });

    map.addLayer(markers);
};

const createMarkerIcon = (cluster, cluster_nb) => {
    const clusterColors = ['#FF0000', '#1E90FF', '#32CD32', '#FFD700'];
    cluster = (cluster_nb === 3 && cluster > 0) ? 0 : cluster;
    console.log(cluster_nb);
    const color = clusterColors[cluster + 1];
    return L.divIcon({
        className: 'marker-icon',
        html: `<div style="background-color: ${color}; width: 20px; height: 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;"></div>`
    });
};

get_clusters(1).then(data => {
    if (data) show_clusters(data);
}).catch(error => {
    console.error('Error:', error);
});
