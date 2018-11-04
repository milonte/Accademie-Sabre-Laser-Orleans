let lat = 48.852969;
let lon = 2.349903;
let macarte = null;

// Initialise la map
// @param [array] coords -> coordonées GPS des gymnases
function initMap(coords) {

    let markers = [];

    // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
    macarte = L.map('map').setView([lat, lon], 11);
    // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
        // Il est toujours bien de laisser le lien vers la source des données
        attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
        minZoom: 1,
        maxZoom: 20
    }).addTo(macarte);
    // Icone des gymnases
    let gymIcon = L.icon({
        iconUrl: '/assets/images/gymIcon.png',
        iconSize: [50, 50],
        iconAnchor: [25, 50],
        popupAnchor: [-3, -76],
      });
    // Ajoute un marqueur pour chaque gymnase
    coords.forEach(coord => {
        marker = L.marker([coord[0], coord[1]], {icon : gymIcon}).addTo(macarte);
        markers.push(marker);
    });
    // Auto zoom (et auto-focus) de la carte par rapport aux marqueurs
    let group = new L.featureGroup(markers);
    macarte.fitBounds(group.getBounds().pad(0.5))
}

