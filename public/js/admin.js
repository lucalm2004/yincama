/* Botones */

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
    buttonClick1();
};

var button2 = document.getElementById('button2');
button2.onclick = function () {
    buttonClick2();
};

var button3 = document.getElementById('button3');
button3.onclick = function () {
    buttonClick3();
};

function buttonClick1(idYin) {
    if (popupContent.classList.contains('shifted1') && !idYin) {
        removeClasses();
        container.style.zIndex = '0';
        popupContent.classList.remove('visible');
    } else {
        var formdata = new FormData();
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        formdata.append('_token', csrfToken);

        var ajax = new XMLHttpRequest();
        ajax.open('POST', '/selectYincana');
        ajax.onload = function () {

            // console.log(ajax.responseText)

            if (ajax.status == 200) {
                var json = JSON.parse(ajax.responseText);
                var html = "<div><h3>Tus Gincanas:</h3><div class='row'><select id='selectYincana' ><option></option>";
                var idCorrect = "";
                var nameCorrect = "";
                var lugaresCorrect = "";

                json.forEach(function (item) {
                    if (idYin && item.id_gim == idYin && idYin != undefined) {
                        html += "<option value='" + item.id_gim + "' selected>" + item.nombre_gim + "</option>";
                        idCorrect = item.id_gim;
                        nameCorrect = item.nombre_gim;

                        lugaresCorrect = item.lugares
                    } else {
                        html += "<option value='" + item.id_gim + "'>" + item.nombre_gim + "</option>";
                    }
                });

                html += "</select></div></div><hr><div>";

                if (idYin == idCorrect && idYin != '') {
                    html += "<form id='updateYincana'><span id='ErrorYincana'></span><div class='row h3-exception'><h3>Nombre: </h3><input id='nameYincana' type='text' value='" + nameCorrect + "'></div>"
                } else {
                    html += "<form id='createYincana'><span id='ErrorYincana'></span><div class='row h3-exception'><h3>Nombre: </h3><input id='nameYincana' type='text'></div>"
                }

                var formdata = new FormData();
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                formdata.append('_token', csrfToken);

                var ajaxExtra = new XMLHttpRequest();
                ajaxExtra.open('POST', '/selectMarcador');
                ajaxExtra.onload = function () {
                    if (ajaxExtra.status == 200) {
                        html += "<div class='locations'>"
                        var num = 5;

                        for (var i = 0; i < num; i++) {
                            html += "<div class='row'><h3>" + (i + 1) + ":</h3><div class='row-before'><select id='marc-" + (i + 1) + "'class='row-exception'><option></option>"

                            var jsonExtra = JSON.parse(ajaxExtra.responseText);

                            if (lugaresCorrect.split(",")[i]) {
                                var marcadores = lugaresCorrect.split(",")[i].split(":")
                            }

                            var selectedId = (marcadores && marcadores.length > 0) ? marcadores[0] : null;

                            jsonExtra.forEach(function (item, i) {
                                if (item.id_lug == selectedId) {
                                    html += "<option value='" + item.id_lug + "' selected>" + item.nombre_lug + "</option>";
                                } else {
                                    html += "<option value='" + item.id_lug + "'>" + item.nombre_lug + "</option>";
                                }
                            });

                            if (selectedId) {
                                html += "</select><textarea id='pista-" + (i + 1) + "' cols='25' rows='2' placeholder='Escribe una pista para la siguiente ubicacion...'>" + marcadores[2] + "</textarea></div></div>";
                            } else {
                                html += "</select><textarea id='pista-" + (i + 1) + "' cols='25' rows='2' placeholder='Escribe una pista para la siguiente ubicacion...'></textarea></div></div>";
                            }
                        }

                        html += "<div class='submit'>"

                        if (idYin == idCorrect && idYin != '') {
                            html += "<button id='formulario'>Actualizar</button><button onclick='elimYincana(event, " + idCorrect + ")' >Eliminar</button></div></form></div>";
                        } else {
                            html += "<button>Crear</button></div></form></div>";
                        }

                        popupContent.innerHTML = html;

                        removeClasses();
                        container.style.zIndex = '999';
                        popupContent.classList.add('visible');
                        popupContent.classList.toggle('shifted1');

                        newYincana();
                        editYincana();
                    }
                };
                ajaxExtra.send(formdata);

            }
        };
        ajax.send(formdata);
    }
}

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

                // console.log(idMar + ' ' + idCorrect)

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
                        html += "<button id='formulario'>Actualizar</button><button onclick='elimMarcador(event, " + idCorrect + ")' >Eliminar</button></div></form></div>";
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
                    html += "</div><div class='submit'><button>Crear</button></div></form ></div > ";
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

function elimMarcador(event, idMar) {
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
            formdata.append('idMar', idMar);

            var ajax = new XMLHttpRequest();
            ajax.open('POST', '/elimMarcador');
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
                }
            };
            ajax.send(formdata);
        }
    });



}


/* Funciones jincana */

function editYincana() {
    document.getElementById('selectYincana').addEventListener('change', function () {
        buttonClick1();
        buttonClick1(document.getElementById('selectYincana').value);
    });

    var updateForm = document.getElementById('updateYincana');
    if (updateForm) {
        updateYincana(document.getElementById('selectYincana').value);
    }
}

function updateYincana(idYin) {
    document.getElementById('formulario').addEventListener('click', function (e) {
        e.preventDefault();

        var nombreYin = document.getElementById('nameYincana').value

        var marca = [
            document.getElementById('marc-1').value,
            document.getElementById('marc-2').value,
            document.getElementById('marc-3').value,
            document.getElementById('marc-4').value,
            document.getElementById('marc-5').value
        ];

        var pista = [
            document.getElementById('pista-1').value,
            document.getElementById('pista-2').value,
            document.getElementById('pista-3').value,
            document.getElementById('pista-4').value,
            document.getElementById('pista-5').value
        ];

        if (nombreYin == '') {
            document.getElementById('nameYincana').style = 'background-color: pink;'

            document.getElementById('ErrorYincana').style = 'color: red;'
            document.getElementById('ErrorYincana').innerHTML = 'Introduce un valor'
        } else {
            var formdata = new FormData();
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formdata.append('_token', csrfToken);

            formdata.append('nombreYin', nombreYin);

            formdata.append('marca', marca);
            formdata.append('pista', pista);

            formdata.append('idYin', idYin);

            var ajax = new XMLHttpRequest();
            ajax.open('POST', '/crearYincana');
            ajax.onload = function () {
                if (ajax.status == 200) {
                    buttonClick1();
                    buttonClick1();

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

function newYincana() {
    var createForm = document.getElementById('createYincana');
    if (createForm) {
        document.getElementById('createYincana').addEventListener('submit', function (e) {
            e.preventDefault();

            var nombreYin = document.getElementById('nameYincana').value

            var marca = [
                document.getElementById('marc-1').value,
                document.getElementById('marc-2').value,
                document.getElementById('marc-3').value,
                document.getElementById('marc-4').value,
                document.getElementById('marc-5').value
            ];

            var pista = [
                document.getElementById('pista-1').value,
                document.getElementById('pista-2').value,
                document.getElementById('pista-3').value,
                document.getElementById('pista-4').value,
                document.getElementById('pista-5').value
            ];

            if (nombreYin == '') {
                document.getElementById('nameYincana').style = 'background-color: pink;'

                document.getElementById('ErrorYincana').style = 'color: red;'
                document.getElementById('ErrorYincana').innerHTML = 'Introduce un valor'
            } else {
                var formdata = new FormData();
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                formdata.append('_token', csrfToken);

                formdata.append('nombreYin', nombreYin);

                formdata.append('marca', marca);
                formdata.append('pista', pista);

                var ajax = new XMLHttpRequest();
                ajax.open('POST', '/crearYincana');
                ajax.onload = function () {
                    if (ajax.status == 200) {
                        if (ajax.responseText === 'error') {
                            document.getElementById('nameYincana').style = 'background-color: pink;'

                            document.getElementById('ErrorYincana').style = 'color: red;'
                            document.getElementById('ErrorYincana').innerHTML = 'Este marcador ya existe'
                        } else {
                            buttonClick1();
                            buttonClick1();

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

function elimYincana(event, idYin) {
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
            formdata.append('idYin', idYin);

            var ajax = new XMLHttpRequest();
            ajax.open('POST', '/elimYincana');
            ajax.onload = function () {
                if (ajax.status == 200) {
                    buttonClick1();
                    buttonClick1();

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



/* Mapa */

// var map = L.map('map', {
//     zoomControl: false
// }).setView([41.3851, 2.1734], 13);

// L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
// }).addTo(map);

// L.control.zoom({
//     position: 'bottomright'
// }).addTo(map);
