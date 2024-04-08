var popupContent = document.querySelector('.popup-content');
var container = document.querySelector('.popup-container');

function removeClasses() {
    popupContent.classList.remove('shifted');
    popupContent.classList.remove('shifted1');
    popupContent.classList.remove('shifted2');
    popupContent.classList.remove('shifted3');
}

var button1 = document.getElementById('button1');
button1.onclick = function () {

    if (popupContent.classList.contains('shifted1')) {
        removeClasses();
        container.style = 'z-index: 0;'
        popupContent.classList.remove('visible'); // Ocultar suavemente
    } else {
        removeClasses();
        container.style = 'z-index: 999;'

        popupContent.classList.add('visible'); // Mostrar suavemente
        popupContent.classList.toggle('shifted1');
    }
};

var button2 = document.getElementById('button2');
button2.onclick = function () {

    if (popupContent.classList.contains('shifted')) {
        removeClasses();
        container.style = 'z-index: 0;'

        popupContent.classList.remove('visible'); // Ocultar suavemente
    } else {
        removeClasses();
        container.style = 'z-index: 999;'

        popupContent.classList.add('visible'); // Mostrar suavemente
        popupContent.classList.toggle('shifted');
    }
};

var button3 = document.getElementById('button3');
button3.onclick = function () {
    if (popupContent.classList.contains('shifted2')) {
        removeClasses();
        container.style = 'z-index: 0;'

        popupContent.classList.remove('visible'); // Ocultar suavemente
    } else {
        removeClasses();
        container.style = 'z-index: 999;'

        popupContent.classList.add('visible'); // Mostrar suavemente
        popupContent.classList.toggle('shifted2');
    }
};

var button4 = document.getElementById('button4');
button4.onclick = function () {
    if (popupContent.classList.contains('shifted3')) {
        removeClasses();
        container.style = 'z-index: 0;'

        popupContent.classList.remove('visible'); // Ocultar suavemente
    } else {
        removeClasses();
        container.style = 'z-index: 999;'

        popupContent.classList.add('visible'); // Mostrar suavemente
        popupContent.classList.toggle('shifted3');
    }
};

var map = L.map('map', {
    zoomControl: false
}).setView([41.3851, 2.1734], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

L.control.zoom({
    position: 'bottomright'
}).addTo(map);
