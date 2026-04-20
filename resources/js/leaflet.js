document.addEventListener("DOMContentLoaded", function () {

    var map = L.map('map').setView([34.68, -1.91], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);

    var logements = window.logements || [];
    var ecoles = window.ecoles || [];

    logements.forEach(function (logement) {
        if (logement.latitude && logement.longitude) {
            L.marker([logement.latitude, logement.longitude])
                .addTo(map)
                .bindPopup(`
                    <b>${logement.titre}</b><br>
                    ${logement.prix} DH<br>
                    <a href="/logements/${logement.id}">Voir</a>
                `);
        }
    });

    ecoles.forEach(function (ecole) {
        L.marker([ecole.latitude, ecole.longitude], {
            icon: L.icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/3135/3135755.png',
                iconSize: [30, 30]
            })
        })
        .addTo(map)
        .bindPopup(`<b>${ecole.nom}</b>`);
    });

    var circles = [];
    var circlesVisible = false;

    window.toggleCircles = function () {
        if (!circlesVisible) {
            ecoles.forEach(function (ecole) {
                var circle = L.circle([ecole.latitude, ecole.longitude], {
                    radius: 2000,
                }).addTo(map);

                circles.push(circle);
            });

            circlesVisible = true;

        } else {
            circles.forEach(function (circle) {
                map.removeLayer(circle);
            });

            circles = [];
            circlesVisible = false;
        }
    }

});