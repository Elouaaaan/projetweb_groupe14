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
        const data = await get_clusters(event.target.value);
        if (data) show_clusters(data);
    });
});

const show_clusters = (cluster_data) => {
    markers.clearLayers();
    cluster_data.forEach(({ longitude, latitude, cluster, nomtech, stadedev, feuillage, haut_tot, tronc_diam, port }) => {
        const marker = L.marker([latitude, longitude], {
            icon: createMarkerIcon(cluster)
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

const createMarkerIcon = (cluster) => {
    const clusterColors = [
        '#FF0000', '#1E90FF', '#32CD32', '#FFD700', '#FF69B4', '#8A2BE2', '#FF4500', '#2E8B57',
        '#8B4513', '#00CED1', '#9400D3', '#FF6347', '#4682B4', '#D2691E', '#00FF7F', '#DC143C',
        '#000080', '#ADFF2F', '#FF8C00', '#9932CC', '#8B0000', '#006400'
    ];
    const color = clusterColors[cluster + 1];
    return L.divIcon({
        className: 'marker-icon',
        html: `<div style="background-color: ${color}; width: 20px; height: 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">${cluster}</div>`
    });
};

get_clusters(1).then(data => {
    if (data) show_clusters(data);
}).catch(error => {
    console.error('Error:', error);
});
