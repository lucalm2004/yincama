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

function buttonClick2(idMar) {
    if (popupContent.classList.contains('shifted') && !idMar) {
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
                var json = JSON.parse(ajax.responseText);
                var html = "<div><h3>Tus marcadores:</h3><select id='selectMarcadores'><option></option>";
                var idCorrect = "";
                var nameCorrect = "";
                var descCorrect = "";
                var catCorrect = "";
                var ubiCorrect = "";

                json.forEach(function (item) {
                    if (idMar && item.id_lug == idMar && idMar != undefined) {
                        html += "<option value='" + item.id_lug + "' selected>" + item.nombre_lug + "</option>";
                        idCorrect = item.id_lug
                        nameCorrect = item.nombre_lug
                        descCorrect = item.desc_lug
                        catCorrect = item.id_tipo
                        ubiCorrect = item.latitud_lug + ',' + item.longitud_lug

                    } else {
                        html += "<option value='" + item.id_lug + "'>" + item.nombre_lug + "</option>";
                    }
                });

                console.log(idMar + ' ' + idCorrect)

                if (idMar == idCorrect && idMar != '') {
                    html += "</select></div><hr class='separator'><form id='updateMarcador'><span id='ErrorMarcador'></span><div><div class='row'><h3>Nombre: </h3><input id='nameMarcador' type='text' value='" + nameCorrect + "'></div><div class='row'><h3>Descripción: </h3><input id='descMarcador' type='text' value='" + descCorrect + "'></div><div class='row'>";
                } else {
                    html += "</select></div><hr class='separator'><form id='createMarcador'><span id='ErrorMarcador'></span><div><div class='row'><h3>Nombre: </h3><input id='nameMarcador' type='text'></div><div class='row'><h3>Descripción: </h3><input id='descMarcador' type='text'></div><div class='row'>";
                }


                html += "<h3>Categoría:</h3><select id='catMarcador'><option></option>";

                var ajaxExtra = new XMLHttpRequest();
                ajaxExtra.open('POST', '/selectCategoria');
                ajaxExtra.onload = function () {
                    if (ajaxExtra.status == 200) {
                        var jsonExtra = JSON.parse(ajaxExtra.responseText);

                        jsonExtra.forEach(function (item) {
                            if (idMar == idCorrect && idMar != '' && catCorrect == item.id_tipo) {
                                html += "<option value='" + item.id_tipo + "' selected>" + item.tipo + "</option>"
                            } else {
                                html += "<option value='" + item.id_tipo + "'>" + item.tipo + "</option>"
                            }
                        });
                    }

                    html += "</select></div><div class='row'><h3>Ubicación: </h3><button>Ver en mapa</button></div><div class='submit'>";

                    if (idMar == idCorrect && idMar != '') {
                        html += "<button id='formulario'>Actualizar</button><button>Eliminar</button></div></form></div>";
                    } else {
                        html += "<button>Crear</button></div></form></div>";
                    }


                    popupContent.innerHTML = html;

                    removeClasses();
                    container.style.zIndex = '999';
                    popupContent.classList.add('visible');
                    popupContent.classList.toggle('shifted');

                    newMarcador();
                    editMarcador();
                };

                ajaxExtra.send(formdata);
            }
        };
        ajax.send(formdata);
    }
}


function buttonClick3(idCat) {
    if (popupContent.classList.contains('shifted2') && !idCat) {
        removeClasses();
        container.style.zIndex = '0';
        popupContent.classList.remove('visible');
    } else {
        var formdata = new FormData();
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        formdata.append('_token', csrfToken);

        var ajax = new XMLHttpRequest();
        ajax.open('POST', '/selectCategoria');
        ajax.onload = function () {
            if (ajax.status == 200) {

                var json = JSON.parse(ajax.responseText);
                var html = "<div><div><h3>Categorias de marcador:</h3><select id='selectCategorias'><option value=''></option>";
                var idCorrect = "";
                var nameCorrect = "";

                json.forEach(function (item) {
                    if (idCat && item.id_tipo == idCat && idCat != undefined) {
                        html += "<option value='" + item.id_tipo + "' selected>" + item.tipo + "</option>";
                        idCorrect = item.id_tipo
                        nameCorrect = item.tipo
                    } else {
                        html += "<option value='" + item.id_tipo + "'>" + item.tipo + "</option>";
                    }
                });

                if (idCat == idCorrect && idCat != '') {
                    html += "</select></div><hr class='separator'><form id='updateCategory'><span id='Error'></span><div class='row'><h3>Nombre: </h3>"
                    html += "<input type='text' id='nameCategory' value='" + nameCorrect + "'></input>"
                    html += "</div><div class='submit'><button id='formulario'>Actualizar</button></form><button onclick='elimCategoria(event, " + idCorrect + ")'>Eliminar</button></div></form></div>";
                } else {
                    html += "</select></div><hr class='separator'><form id='createCategory'><span id='Error'></span><div class='row'><h3>Nombre: </h3>"
                    html += "<input type='text' id='nameCategory'></input>"
                    html += "</div><div class='submit'><button>Crear</button></div></form></div>";
                }
                popupContent.innerHTML = html;

                removeClasses();

                container.style.zIndex = '999';
                popupContent.classList.add('visible'); // Mostrar suavemente
                popupContent.classList.toggle('shifted2');

                newCategoria();
                editCategoria();
            }
        };
        ajax.send(formdata);
    }
}


/* Funciones categorias */

function editCategoria() {
    document.getElementById('selectCategorias').addEventListener('change', function () {
        buttonClick3();
        buttonClick3(document.getElementById('selectCategorias').value);
    });

    var updateForm = document.getElementById('updateCategory');
    if (updateForm) {
        updateCategory(document.getElementById('selectCategorias').value);
    }
}

function updateCategory(idCat) {
    document.getElementById('formulario').addEventListener('click', function (e) {
        e.preventDefault();

        var nombreCat = document.getElementById('nameCategory').value

        if (nombreCat == '') {
            document.getElementById('nameCategory').style = 'background-color: pink;'

            document.getElementById('Error').style = 'color: red;'
            document.getElementById('Error').innerHTML = 'Introduce un valor valido'
        } else {
            var formdata = new FormData();
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formdata.append('_token', csrfToken);
            formdata.append('nombreCat', nombreCat);
            formdata.append('idCat', idCat);

            var ajax = new XMLHttpRequest();
            ajax.open('POST', '/crearCategoria');
            ajax.onload = function () {
                if (ajax.status == 200) {
                    if (ajax.responseText === 'error') {
                        document.getElementById('nameCategory').style = 'background-color: pink;'

                        document.getElementById('Error').style = 'color: red;'
                        document.getElementById('Error').innerHTML = 'Este marcador ya existe'
                    } else {
                        buttonClick3();
                        buttonClick3();

                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1250,
                            width: "200px",
                            background: "#293A68"
                        });
                    }
                }
            };
            ajax.send(formdata);

        }
    })
}

function newCategoria() {
    var createForm = document.getElementById('createCategory');
    if (createForm) {
        document.getElementById('createCategory').addEventListener('submit', function (e) {
            e.preventDefault();

            var nombreCat = document.getElementById('nameCategory').value

            if (nombreCat == '') {
                document.getElementById('nameCategory').style = 'background-color: pink;'

                document.getElementById('Error').style = 'color: red;'
                document.getElementById('Error').innerHTML = 'Introduce un valor valido'
            } else {
                var formdata = new FormData();
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                formdata.append('_token', csrfToken);
                formdata.append('nombreCat', nombreCat);

                var ajax = new XMLHttpRequest();
                ajax.open('POST', '/crearCategoria');
                ajax.onload = function () {
                    if (ajax.status == 200) {
                        if (ajax.responseText === 'error') {
                            document.getElementById('nameCategory').style = 'background-color: pink;'

                            document.getElementById('Error').style = 'color: red;'
                            document.getElementById('Error').innerHTML = 'Este marcador ya existe'
                        } else {
                            buttonClick3();
                            buttonClick3();

                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1250,
                                width: "200px",
                                background: "#293A68"
                            });
                        }
                    }
                };
                ajax.send(formdata);
            }
        })
    }
}

function elimCategoria(event, idCat) {
    event.preventDefault();

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success btn-lg",
            cancelButton: "btn btn-danger btn-lg"
        },
        buttonsStyling: true
    });

    swalWithBootstrapButtons.fire({
        title: "Seguro que quiere eliminarlo?",
        text: "Este cambio será permanente",
        icon: "warning",
        color: "#fff",
        showCancelButton: true,
        position: "top-end",
        cancelButtonText: "No",
        confirmButtonText: "Si",
        reverseButtons: true,
        background: "#293A68"
    }).then((result) => {
        if (result.isConfirmed) {
            var formdata = new FormData();
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formdata.append('_token', csrfToken);
            formdata.append('idCat', idCat);

            var ajax = new XMLHttpRequest();
            ajax.open('POST', '/elimCategoria');
            ajax.onload = function () {
                if (ajax.status == 200) {
                    buttonClick3();
                    buttonClick3();

                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1250,
                        width: "200px",
                        background: "#293A68"
                    });
                }
            };
            ajax.send(formdata);
        }
    });



}

/* Funciones marcadores */

function editMarcador() {
    document.getElementById('selectMarcadores').addEventListener('change', function () {
        buttonClick2();
        buttonClick2(document.getElementById('selectMarcadores').value);
    });

    var updateForm = document.getElementById('updateMarcador');
    if (updateForm) {
        updateMarcador(document.getElementById('selectMarcadores').value);
    }
}

function updateMarcador(idMar) {
    document.getElementById('formulario').addEventListener('click', function (e) {
        e.preventDefault();

        var nombreMar = document.getElementById('nameMarcador').value
        var descripcionCat = document.getElementById('descMarcador').value
        var catMar = document.getElementById('catMarcador').value

        if (nombreMar == '' || descripcionCat == '' || catMar == '') {

            document.getElementById('ErrorMarcador').style = 'color: red;'
            document.getElementById('ErrorMarcador').innerHTML = 'Introduce todos los valores'
        } else {
            var formdata = new FormData();
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formdata.append('_token', csrfToken);
            formdata.append('nombreMar', nombreMar);
            formdata.append('descripcionCat', descripcionCat);
            formdata.append('catMar', catMar);
            formdata.append('idMar', idMar);

            var ajax = new XMLHttpRequest();
            ajax.open('POST', '/crearMarcador');
            ajax.onload = function () {
                if (ajax.status == 200) {
                    buttonClick2();
                    buttonClick2();

                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1250,
                        width: "200px",
                        background: "#293A68"
                    });
                } else {
                    console.log(ajax.responseText)
                }
            };
            ajax.send(formdata);

        }
    })
}

function newMarcador() {
    var createForm = document.getElementById('createMarcador');
    if (createForm) {
        document.getElementById('createMarcador').addEventListener('submit', function (e) {
            e.preventDefault();

            var nombreMar = document.getElementById('nameMarcador').value
            var descripcionMar = document.getElementById('descMarcador').value
            var catMar = document.getElementById('catMarcador').value

            if (nombreMar == '' || descripcionMar == '' || catMar == '') {

                document.getElementById('ErrorMarcador').style = 'color: red;'
                document.getElementById('ErrorMarcador').innerHTML = 'Introduce todos los valores'
            } else {
                var formdata = new FormData();
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                formdata.append('_token', csrfToken);
                formdata.append('nombreMar', nombreMar);
                formdata.append('descripcionMar', descripcionMar);
                formdata.append('catMar', catMar);

                var ajax = new XMLHttpRequest();
                ajax.open('POST', '/crearMarcador');
                ajax.onload = function () {
                    console.log(ajax.responseText)
                    if (ajax.status == 200) {
                        buttonClick2();
                        buttonClick2();

                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1250,
                            width: "200px",
                            background: "#293A68"
                        });
                    }
                };
                ajax.send(formdata);
            }
        })
    }
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
