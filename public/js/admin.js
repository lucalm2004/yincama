/* Botones */

document.addEventListener("DOMContentLoaded", () => {
    // Code to run when DOM content is loaded
});

var popupContent = document.querySelector('.popup-content');
var container = document.querySelector('.popup-container');

function removeClasses() {
    popupContent.classList.remove('shifted');
    popupContent.classList.remove('shifted1');
    popupContent.classList.remove('shifted2');
    // popupContent.classList.remove('shifted3'); // Not used
}

var button1 = document.getElementById('button1');
button1.onclick = function () {
    if (popupContent.classList.contains('shifted1')) {
        removeClasses();
        container.style.zIndex = '0'; // Modified
        popupContent.classList.remove('visible'); // Ocultar suavemente
    } else {
        removeClasses();
        container.style.zIndex = '999'; // Modified
        popupContent.classList.add('visible'); // Mostrar suavemente
        popupContent.classList.toggle('shifted1');
    }
};

var button2 = document.getElementById('button2');
button2.onclick = function () {
    buttonClick2();
};

var button3 = document.getElementById('button3');
button3.onclick = function () {
    buttonClick3();
};

function buttonClick2() {
    if (popupContent.classList.contains('shifted')) {
        removeClasses();
        container.style.zIndex = '0';
        popupContent.classList.remove('visible'); // Ocultar suavemente
    } else {
        var formdata = new FormData();
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        formdata.append('_token', csrfToken);

        var ajax = new XMLHttpRequest();
        ajax.open('POST', '/selectMarcador');
        ajax.onload = function () {
            if (ajax.status == 200) {
                console.log(ajax.responseText)

                var json = JSON.parse(ajax.responseText);
                var html = "<div><h3>Tus marcadores:</h3><select><option></option>";
                json.forEach(function (item) {
                    html += "<option value='" + item.id_lug + "'>" + item.nombre_lug + "</option>";
                });
                html += "</select></div><hr class='separator'><div><div class='row'><h3>Nombre: </h3><input type='text'></div><div class='row'><h3>Descripción: </h3><input type='text'></div><div class='row'><h3>Categoría:</h3><input type='text'></div><div class='row'><h3>Ubicación: </h3><button>Ver en mapa</button></div><div class='submit'><button>Crear</button><button>Eliminar</button></div></div>";
                popupContent.innerHTML = html;

                removeClasses();

                container.style.zIndex = '999';
                popupContent.classList.add('visible');
                popupContent.classList.toggle('shifted');
            }
        };
        ajax.send(formdata);
    }

}

function buttonClick3(idCat) {
    if (popupContent.classList.contains('shifted2') && !idCat) {
        removeClasses();
        container.style.zIndex = '0';
        popupContent.classList.remove('visible'); // Ocultar suavemente
    } else {
        var formdata = new FormData();
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        formdata.append('_token', csrfToken);

        if (idCat) {
            formdata.append('idCat', idCat);
        }

        var ajax = new XMLHttpRequest();
        ajax.open('POST', '/selectCategoria');
        ajax.onload = function () {
            if (ajax.status == 200) {

                var json = JSON.parse(ajax.responseText);
                var html = "<div><div><h3>Categorias de marcador:</h3><select id='selectCategorias'><option value=''></option>";
                json.forEach(function (item) {
                    html += "<option value='" + item.id_tipo + "'>" + item.tipo + "</option>";
                });
                html += "</select></div><hr class='separator'><form id='createCategory'><div class='row'><h3>Nombre: </h3><input type='text' id='nameCategory'></div><div class='submit'><button>Crear</button><button>Eliminar</button></div></form></div>";
                popupContent.innerHTML = html;

                removeClasses();

                container.style.zIndex = '999';
                popupContent.classList.add('visible'); // Mostrar suavemente
                popupContent.classList.toggle('shifted2');

                newCategoria();
                editCategoria();
            } else {
                console.log(ajax.responseText);
            }
        };
        ajax.send(formdata);
    }
}


/* Formularios */

function editCategoria() {
    document.getElementById('selectCategorias').addEventListener('change', function () {
        buttonClick3()
        buttonClick3(document.getElementById('selectCategorias').value)
    })
}

function newCategoria() {
    document.getElementById('createCategory').addEventListener('submit', function (e) {
        e.preventDefault();

        var nombreCat = document.getElementById('nameCategory').value

        var formdata = new FormData();
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        formdata.append('_token', csrfToken);
        formdata.append('nombreCat', nombreCat);

        var ajax = new XMLHttpRequest();
        ajax.open('POST', '/crearCategoria');
        ajax.onload = function () {
            if (ajax.status == 200) {
                buttonClick3();
                buttonClick3();
            }
        };
        ajax.send(formdata);
    })
}


/* Mapa */

var map = L.map('map', {
    zoomControl: false
}).setView([41.3851, 2.1734], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

L.control.zoom({
    position: 'bottomright'
}).addTo(map);
