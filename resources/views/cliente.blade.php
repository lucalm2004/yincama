<?php
if (!session('id_user')) {
    header('Location: /');
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Leaflet Map with Icons</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" crossorigin="" />

    <!-- Esri Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@3.1.3/dist/esri-leaflet-geocoder.css" crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <!-- Leaflet Locate Control CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.css" />

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/2b5286e1aa.js" crossorigin="anonymous"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" crossorigin=""></script>

    <!-- Esri Leaflet JS -->
    <script src="https://unpkg.com/esri-leaflet@3.0.10/dist/esri-leaflet.js"></script>

    <!-- Esri Leaflet Geocoder JS -->
    <script src="https://unpkg.com/esri-leaflet-geocoder@3.1.3/dist/esri-leaflet-geocoder.js" crossorigin=""></script>

    <!-- Leaflet Routing Machine JS -->
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

    <!-- Leaflet Locate Control JS -->
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.js" charset="utf-8"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');

        #Favoritos {
            max-height: 100%;
            overflow-y: scroll;
        }

        #button1 {
            background-image: url(../img/gimcana.png);
            background-size: cover;
            margin: 0.5rem;
        }

#btnFiltrar{
margin-left: 32.5%;
margin-top: 5%;
}

        #button2 {
            background-image: url(../img/usuario.png);
            background-size: cover;
        }

        #button3 {
            background-image: url(../img/favoritos.png);
            background-size: cover;
        }

        #button4 {
            background-image: url(https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/Hamburger_icon_white.svg/1024px-Hamburger_icon_white.svg.png);
            background-size: cover;
        }

        body,
        html {
            font-family: "Inter", sans-serif;

            margin: 0;
            padding: 0;
            height: 100%;
        }

        #map {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 0;
        }

        .buttons-container {
            top: 1%;
            position: absolute;
            height: 12%;
            width: 100%;
            z-index: 999;
            display: flex;
            justify-content: center;
            align-items: center;
            bottom: 88%;
        }

        .checkbox-wrapper-16 *,
        .checkbox-wrapper-16 *:after,
        .checkbox-wrapper-16 *:before {
            box-sizing: border-box;
        }

        .checkbox-wrapper-16 .checkbox-input {
            clip: rect(0 0 0 0);
            -webkit-clip-path: inset(100%);
            clip-path: inset(100%);
            height: 1px;
            overflow: hidden;
            position: absolute;
            white-space: nowrap;
            width: 1px;
        }

        .checkbox-wrapper-16 .checkbox-input:checked+.checkbox-tile {
            border-color: #2260ff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            color: #2260ff;
        }

        .checkbox-wrapper-16 .checkbox-input:checked+.checkbox-tile:before {
            transform: scale(1);
            opacity: 1;
            background-color: #2260ff;
            border-color: #2260ff;
        }

        .checkbox-wrapper-16 .checkbox-input:checked+.checkbox-tile .checkbox-icon,
        .checkbox-wrapper-16 .checkbox-input:checked+.checkbox-tile .checkbox-label {
            color: #2260ff;
        }

        .checkbox-wrapper-16 .checkbox-input:focus+.checkbox-tile {
            border-color: #2260ff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1), 0 0 0 4px #b5c9fc;
        }

        .checkbox-wrapper-16 .checkbox-input:focus+.checkbox-tile:before {
            transform: scale(1);
            opacity: 1;
        }

        .checkbox-wrapper-16 .checkbox-tile {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 7rem;
            min-height: 7rem;
            border-radius: 0.5rem;
            border: 2px solid #b5bfd9;
            background-color: #fff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            transition: 0.15s ease;
            cursor: pointer;
            position: relative;
        }

        .checkbox-wrapper-16 .checkbox-tile:before {
            content: "";
            position: absolute;
            display: block;
            width: 1.25rem;
            height: 1.25rem;
            border: 2px solid #b5bfd9;
            background-color: #fff;
            border-radius: 50%;
            top: 0.25rem;
            left: 0.25rem;
            opacity: 0;
            transform: scale(0);
            transition: 0.25s ease;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='192' height='192' fill='%23FFFFFF' viewBox='0 0 256 256'%3E%3Crect width='256' height='256' fill='none'%3E%3C/rect%3E%3Cpolyline points='216 72.005 104 184 48 128.005' fill='none' stroke='%23FFFFFF' stroke-linecap='round' stroke-linejoin='round' stroke-width='32'%3E%3C/polyline%3E%3C/svg%3E");
            background-size: 12px;
            background-repeat: no-repeat;
            background-position: 50% 50%;
        }

        .checkbox-wrapper-16 .checkbox-tile:hover {
            border-color: #2260ff;
        }

        .checkbox-wrapper-16 .checkbox-tile:hover:before {
            transform: scale(1);
            opacity: 1;
        }

        .checkbox-wrapper-16 .checkbox-icon {
            transition: 0.375s ease;
            color: #494949;
        }

        .checkbox-wrapper-16 .checkbox-icon svg {
            width: 3rem;
            height: 3rem;
        }

        .checkbox-wrapper-16 .checkbox-label {
            color: #707070;
            transition: 0.375s ease;
            text-align: center;
        }

        .button {
            height: 5rem;
            width: 5rem;
            background-color: #293A68;
            border-radius: 1rem;
            margin: 0 0.5rem;
        }

        .popup-container {
            position: absolute;
            /* z-index: 999; */
            width: 100%;
            height: 70vh;
            top: 18.5%;
            display: flex;
            justify-content: center;
            align-items: center;
        }


        .leaflet-popup-close-button {
            background-color: black !important;
            color: white !important;
            /* padding: 1.5% 4%!important; */
            margin: 1%;
            border-radius: 100% !important;
        }

        .leaflet-popup {
            width: 200px;
        }

        .leaflet-top {
            margin-top: 25% !important
        }

        .popup-content {
            background-color: #293A68;
            height: 70vh;
            width: 90vw;
            position: relative;
            border-radius: 1rem;
            margin: 19px;
            opacity: 0;
            /* Inicialmente oculto */
            transition: opacity 0.5s ease;
            /* Transición de opacidad */
        }

        .popup-content.visible {
            opacity: 1;
            /* Hacer visible */
        }


        .popup-content::after {
            width: 0;
            content: "";
            border: 15px solid transparent;
            border-bottom-color: #293A68;
            border-top: 0;
            position: absolute;
            top: -14px;
            /* Cambiar el % para definir la posicion horizontal */
            left: calc(10% - 15px);
            opacity: 0;
            /* Inicialmente oculto */
            transition: opacity 0.5s ease;
        }

        .popup-content.shifted::after {
            left: calc(36.5% - 15px);
            opacity: 1;
            /* Inicialmente oculto */

        }

        .popup-content.shifted1::after {
            left: calc(10% - 15px);
            opacity: 1;
            /* Inicialmente oculto */

        }

#check{
margin-left: 15%;}

        .popup-content.shifted2::after {
            left: calc(63.5% - 15px);
            opacity: 1;
            /* Inicialmente oculto */

        }

        .favorito {
            background-color: black !important;
            border-radius: 20px;
            padding: 5%;
            margin-bottom: 2%;
            /* border: 1px solid black; */
        }

        .btn_llegar {

            border: none;

            background-color: #F9F7D0;
            height: 25px;
            border-radius: 1rem;
            border: 1px solid;
        }

        .popup-content.shifted3::after {
            left: calc(91% - 15px);
            opacity: 1;
            /* Inicialmente oculto */

        }

        .logout {
            position: fixed;
            top: 92.5%;
            left: 85%;
            transform: translate(-50%, -50%);
            z-index: 10;
            background-color: #FF5A5A;
            color: white;
            padding: 4vw 8vw;
            border: none;
            border-radius: 20px;
            font-size: 6vw;
            font-family: Arial, sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .logout:hover {
            background-color: #FF7878;
            /* Rojo claro */
        }
    </style>
</head>

<body>
    <div id="popup-container" class="popup-container">
        <div id="popup-view" class="popup-content">
            <div id="Favoritos" style="display: none"></div>
            <div id="check" style="display: none;     flex-wrap: wrap;"></div>

            <div id="yinkamas" style="display: none;">
                <script>
                    $(document).ready(function() {
                        $.ajax({
                            url: "{{ route('modal.index') }}",
                            method: 'GET',
                            success: function(response) {
                                $('#yinkamas').html(response);
                            },
                            error: function(xhr, status, error) {
                                console.error('Hubo un error al obtener las incidencias:', error);
                            }
                        });
                    });
                </script>
            </div>

            <div id="perfil" style="display: none;">
                <script>
                    function cargarPerfil() {
                        $.ajax({
                            url: "{{ route('perfil.index') }}",
                            method: 'GET',
                            success: function(response) {
                                $('#perfil').html(response);
                            },
                            error: function(xhr, status, error) {
                                console.error('Hubo un error al obtener las incidencias:', error);
                            }
                        });
                    }
                </script>
            </div>
        </div>
    </div>




    <div id="mostrar_mapa"></div>
    {{-- <div id="map"></div> --}}
    <input type="hidden" id="array_filtro" value="1,2,3,4,5,6,7,8,9,10">


    <div class='buttons-container'>
        <div id='button1' class='button'></div>
        <div id='button2' class='button'></div>
        <div id='button3' class='button'></div>
        <div id='button4' class='button'></div>
    </div>
    <button class="logout" id="salir">Salir</button>
    {{-- <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" crossorigin=""></script> --}}

    <script>
        var popupContent = document.querySelector('.popup-content');
        var container = document.querySelector('.popup-container');

        function removeClasses() {
            popupContent.classList.remove('shifted');
            popupContent.classList.remove('shifted1');
            popupContent.classList.remove('shifted2');
            popupContent.classList.remove('shifted3');
        }

        var button1 = document.getElementById('button1');
        button1.onclick = function() {
            document.getElementById('yinkamas').style.display = 'grid';
            document.getElementById('perfil').style.display = 'none';
            document.getElementById('Favoritos').style.display = 'none'
            document.getElementById('check').style.display = 'none';

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

        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("salir").addEventListener("click", salir);
        });

        function salir() {
            window.location.href = "salir";
        }

        var button2 = document.getElementById('button2');
        button2.onclick = function() {
            cargarPerfil();

            document.getElementById('perfil').style.display = 'grid';
            document.getElementById('Favoritos').style.display = 'none';

            document.getElementById('yinkamas').style.display = 'none';
            document.getElementById('Favoritos').style.display = 'none'

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
        button3.onclick = function() {
            document.getElementById('yinkamas').style.display = 'none';
            document.getElementById('Favoritos').style.display = 'block';
            document.getElementById('perfil').style.display = 'none';
            document.getElementById('check').style.display = 'none';


            mostrarFavoritos();
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
        button4.onclick = function() {
            document.getElementById('Favoritos').style.display = 'none';
            document.getElementById('perfil').style.display = 'none';

            document.getElementById('yinkamas').style.display = 'none';
            document.getElementById('Favoritos').style.display = 'none';
            /* Añadir id para lo de los filtrps  */
            document.getElementById('check').style.display = 'flex';
            mostrarFiltros();
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

        function mostrarFiltros() {


            var ajax = new XMLHttpRequest();
            var formdata = new FormData();

            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formdata.append('_token', csrfToken);

            ajax.open('POST', 'mostrar_tipos');

            ajax.onload = function() {
                if (ajax.status == 200) {

                    var json = JSON.parse(ajax.responseText);
                    var mostrar_tipos = json.mostrar_tipos;

                    var contenidoHtml = ''; // Variable para almacenar el contenido HTML
                    var tipos_array = document.getElementById("array_filtro").value
                    var valoresArray = tipos_array.split(',').map(Number); // Convertir valores a n�meros
                    console.log(valoresArray)
                    contenidoHtml += "<div style='display: flex;flex-wrap: wrap;'>";

                    mostrar_tipos.forEach(function(item) {
                        console.log(item.id_tipo)
                        var tipo = item.id_tipo;
                        if (valoresArray.includes(parseInt(item
                                .id_tipo))) { // Convertir id_tipo a n�mero antes de la comparaci�n
                            contenidoHtml +=
                                "<div class='checkbox-wrapper-16'><label class='checkbox-wrapper'><input type='checkbox' checked id='" + tipo + "' name='" + item.tipo + "' class='checkbox-input' /><span class='checkbox-tile'><span class='checkbox-label'>" +
                                item.tipo + "</span></span></label></div></div>";
                        } else {
                            contenidoHtml +=
                                "<div class='checkbox-wrapper-16'><label class='checkbox-wrapper'><input type='checkbox' id='" + tipo + "' name='" + item.tipo + "' class='checkbox-input' /><span class='checkbox-tile'><span class='checkbox-label'>" +
                                item.tipo + "</span></span></label></div></div>";
                        }

                    });
                    contenidoHtml += "</div>";

                    contenidoHtml +=
                        "<input type='button' id='btnFiltrar' class='btn_llegar' value='Filtrar' onclick='filtrarDatos()'>";


                    // Mostrar el contenido en el elemento con id 'ventana_azul'
                    var check = document.getElementById("check");
                    if (check) {
                        check.innerHTML = contenidoHtml;
                    } else {
                        console.error('Error: No se encontr� el elemento con id "ventana_azul"');
                    }
                } else {
                    console.error('Error en la petici�n AJAX');
                }
            };

            ajax.onerror = function() {
                console.error('Error en la petici�n AJAX');
            };

            ajax.send(formdata);
        }
        // Favoritos
        var controlOk;
        var controlOk2;

        function mostrarEvent(event) {
            var como_llegar = document.getElementsByName("btn_llegae");
            console.log(controlOk)

            if (controlOk === false) {
                routingControl.spliceWaypoints(0, 1); // Elimina el marcador de inicio (índice 0)
                routingControl.spliceWaypoints(routingControl.getWaypoints().length - 1,
                    1); // Elimina el marcador de destino (último índice)
                console.log(controlOk)

            }
            controlOk = true;
            controlOk2 = false;


            document.getElementById('popup-container').style.zIndex = 0;
            for (let i = 0; i < como_llegar.length; i++) {
                var latitud = event.target.id;
                var longitud = event.target.value;
                console.log(latitud);
                console.log(longitud);
                navigator.geolocation.getCurrentPosition(function(position) {
                    var currentLatLng = L.latLng(position.coords.latitude, position.coords.longitude);
                    routingControl = L.Routing.control({
                        waypoints: [
                            currentLatLng,
                            L.latLng(latitud, longitud)
                        ],
                        routeWhileDragging: true,
                    }).addTo(map);

                });
            }
        }

        function mostrarFavoritos() {
            var ajax = new XMLHttpRequest();
            var formdata = new FormData();

            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formdata.append('_token', csrfToken);

            ajax.open('POST', 'mostrar_favorito');

            ajax.onload = function() {
                if (ajax.status == 200) {

                    var json = JSON.parse(ajax.responseText);
                    var favoritos = json.favoritos;

                    var contenidoHtml = ''; // Variable para almacenar el contenido HTML

                    favoritos.forEach(function(item) {
                        contenidoHtml += "<div class='favorito'>"
                        contenidoHtml += "<h3>" + item.nombre_lug + "</h3>";
                        contenidoHtml += "<p>" + item.barrio_lug + "</p>";
                        contenidoHtml += "<p>" + item.desc_lug + "</p>";
                        if (controlOk2 === false) {
                            contenidoHtml +=
                                "<button type='button' class='btn_llegar' id='btn_fav' onclick='darFavorito(" +
                                item.id_lug + ")'" +
                                item.id_lug +
                                "' value='" + item.tipo_lug +
                                "'> Quitar de Favoritos </button>";

                        } else {
                            contenidoHtml +=
                                "<button type='button' class='btn_llegar' id='btn_fav' onclick='darFavorito(" +
                                item.id_lug + ")'" +
                                item.id_lug +
                                "' value='" + item.tipo_lug +
                                "'> Quitar de Favoritos </button><button onclick='mostrarEvent(event)' type='button' name='btn_llegae' id='" +
                                item.latitud_lug + "' value='" + item.longitud_lug +
                                "' class='btn btn_llegar'>Como Llegar</button>";

                        }
                        contenidoHtml += "</div>"



                    });

                    // Mostrar el contenido en el elemento con id 'ventana_azul'
                    var ventanaAzul = document.getElementById("Favoritos");
                    if (ventanaAzul) {
                        ventanaAzul.innerHTML = contenidoHtml;
                    } else {
                        console.error('Error: No se encontró el elemento con id "ventana_azul"');
                    }
                } else {
                    console.error('Error en la petición AJAX');
                }
            };

            ajax.onerror = function() {
                console.error('Error en la petición AJAX');
            };

            ajax.send(formdata);
        }

        function filtrarDatos() {
            // var ajax = new XMLHttpRequest();
            // var formdata = new FormData();

            // var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            // formdata.append('_token', csrfToken);

            // Array para almacenar los valores de los checkboxes marcados
            let checkboxesMarcados = [];

            // Obtener todos los checkboxes del documento
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');

            // Iterar sobre los checkboxes para verificar cu�les est�n marcados
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    // Agregar el valor del checkbox a la array si est� marcado
                    checkboxesMarcados.push(checkbox.id);
                }
            });

            // Mostrar los checkboxes marcados en la consola (puedes hacer lo que quieras con esta array)
            console.log('Checkboxes Marcados:', checkboxesMarcados);
            document.getElementById("array_filtro").value = checkboxesMarcados;


            document.getElementById("mostrar_mapa").innerHTML = "<div id='map'></div>";
            var map = L.map('map', {

                zoomControl: false
            }).setView([41.3851, 2.1734], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // L.control.zoom({
            //     position: 'bottomright'
            // }).addTo(map);
            var guardar_array = document.getElementById("array_filtro").value
            var valoresArray = guardar_array.split(',');
            console.log(valoresArray)
            if (valoresArray.includes('1')) {

                ListarLugares_Museos(map);
            }

            if (valoresArray.includes('2')) {
                ListarLugares_Playas(map);
            }

            if (valoresArray.includes('3')) {
                ListarLugares_Bares(map);
            }

            if (valoresArray.includes('4')) {
                ListarLugares_Discoteca(map);
            }
            if (valoresArray.includes('5')) {
                ListarLugares_Monumento(map);
            }
            if (valoresArray.includes('6')) {
                ListarLugares_Parques(map);
            }
            if (valoresArray.includes('7')) {
                ListarLugares_Restaurante(map);
            }
            if (valoresArray.includes('8')) {
                ListarLugares_Estacion(map);
            }
            if (valoresArray.includes('9')) {
                ListarLugares_CentroComercial(map);
            }
            if (valoresArray.includes('10')) {
                ListarLugares_Teatro(map);
            }

            var lc = L.control.locate({
                drawCircle: true,
                circleStyle: {
                    radius: 200

                }
            }).addTo(map);

            const
                apiKey =
                "AAPK81ad74d3dfd8436fb340536133638fa63ALxp-zis1f4_UJQXProlf6PHzR0q-zOvEnfcnjIbYi2VLIrKWd86ViJHzwjoKVJ";

            const
                apiKey2 =
                "https://nominatim.openstreetmap.org/search?q=1600+Amphitheatre+Parkway,+Mountain+View,+CA&format=json";

            lc.start();
            // darFavorito();
            // Define el �cono que se utilizar� para los marcadores
            var icono = L.icon({
                iconUrl: "{{ asset('img/marcador_teatro.png') }}",
                iconSize: [30, 30], // Tama�o del �cono
                iconAnchor: [15, 30], // Punto de anclaje del �cono
                popupAnchor: [0, -30] // Punto donde se abrir� el popup en relaci�n al �cono
            });

            // Marcador del teatro, PASARLE A LUCA
            // Define el �cono personalizado
            // Define el �cono personalizado en Leaflet utilizando la ruta proporcionada por Laravel con asset()
            var icono_teatro = L.icon({
                iconUrl: "{{ asset('img/marcador_te.jpg') }}", // Ruta de tu imagen de �cono proporcionada por Laravel
                iconSize: [30, 30], // Tama�o del �cono [ancho, alto]
                iconAnchor: [15,
                    30
                ], // Punto de anclaje del �cono relativo a su posici�n [horizontal, vertical]
                popupAnchor: [0, -
                    30
                ] // Punto donde se abrir� el popup en relaci�n al �cono [horizontal, vertical]
            });


            var icono_playa = L.icon({
                iconUrl: "{{ asset('img/marcador_playa.png') }}", // Ruta de tu imagen de �cono proporcionada por Laravel
                iconSize: [30, 30], // Tama�o del �cono [ancho, alto]
                iconAnchor: [15,
                    30
                ], // Punto de anclaje del �cono relativo a su posici�n [horizontal, vertical]
                popupAnchor: [0, -
                    30
                ] // Punto donde se abrir� el popup en relaci�n al �cono [horizontal, vertical]
            });


            var icono_museo = L.icon({
                iconUrl: "{{ asset('img/marcador_museo.png') }}", // Ruta de tu imagen de �cono proporcionada por Laravel
                iconSize: [30, 30], // Tama�o del �cono [ancho, alto]
                iconAnchor: [15,
                    30
                ], // Punto de anclaje del �cono relativo a su posici�n [horizontal, vertical]
                popupAnchor: [0, -
                    30
                ] // Punto donde se abrir� el popup en relaci�n al �cono [horizontal, vertical]
            });

            var icono_bar = L.icon({
                iconUrl: "{{ asset('img/marcador_bar.png') }}", // Ruta de tu imagen de �cono proporcionada por Laravel
                iconSize: [30, 30], // Tama�o del �cono [ancho, alto]
                iconAnchor: [15,
                    30
                ], // Punto de anclaje del �cono relativo a su posici�n [horizontal, vertical]
                popupAnchor: [0, -
                    30
                ] // Punto donde se abrir� el popup en relaci�n al �cono [horizontal, vertical]
            });


            var icono_parque = L.icon({
                iconUrl: "{{ asset('img/marcador_parque.png') }}", // Ruta de tu imagen de �cono proporcionada por Laravel
                iconSize: [30, 30], // Tama�o del �cono [ancho, alto]
                iconAnchor: [15,
                    30
                ], // Punto de anclaje del �cono relativo a su posici�n [horizontal, vertical]
                popupAnchor: [0, -
                    30
                ] // Punto donde se abrir� el popup en relaci�n al �cono [horizontal, vertical]
            });


            var icono_discoteca = L.icon({
                iconUrl: "{{ asset('img/marcador_discoteca.png') }}", // Ruta de tu imagen de �cono proporcionada por Laravel
                iconSize: [30, 30], // Tama�o del �cono [ancho, alto]
                iconAnchor: [15,
                    30
                ], // Punto de anclaje del �cono relativo a su posici�n [horizontal, vertical]
                popupAnchor: [0, -
                    30
                ] // Punto donde se abrir� el popup en relaci�n al �cono [horizontal, vertical]
            });

            var icono_monumento = L.icon({
                iconUrl: "{{ asset('img/marcador_monumento.png') }}", // Ruta de tu imagen de �cono proporcionada por Laravel
                iconSize: [30, 30], // Tama�o del �cono [ancho, alto]
                iconAnchor: [15,
                    30
                ], // Punto de anclaje del �cono relativo a su posici�n [horizontal, vertical]
                popupAnchor: [0, -
                    30
                ] // Punto donde se abrir� el popup en relaci�n al �cono [horizontal, vertical]
            });


            var icono_restaurante = L.icon({
                iconUrl: "{{ asset('img/marcador_restaurante.png') }}", // Ruta de tu imagen de �cono proporcionada por Laravel
                iconSize: [30, 30], // Tama�o del �cono [ancho, alto]
                iconAnchor: [15,
                    30
                ], // Punto de anclaje del �cono relativo a su posici�n [horizontal, vertical]
                popupAnchor: [0, -
                    30
                ] // Punto donde se abrir� el popup en relaci�n al �cono [horizontal, vertical]
            });

            var icono_estacion = L.icon({
                iconUrl: "{{ asset('img/marcador_estacion.png') }}", // Ruta de tu imagen de �cono proporcionada por Laravel
                iconSize: [30, 30], // Tama�o del �cono [ancho, alto]
                iconAnchor: [15,
                    30
                ], // Punto de anclaje del �cono relativo a su posici�n [horizontal, vertical]
                popupAnchor: [0, -
                    30
                ] // Punto donde se abrir� el popup en relaci�n al �cono [horizontal, vertical]
            });




        }
        document.getElementById("mostrar_mapa").innerHTML = "<div id='map'></div>";
        var map = L.map('map', {
            zoomControl: false
        }).setView([41.3851, 2.1734], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // L.control.zoom({
        //     position: 'bottomright'
        // }).addTo(map);
        var guardar_array = document.getElementById("array_filtro").value
        var valoresArray = guardar_array.split(',');
        console.log(valoresArray)
        if (valoresArray.includes('1')) {

            ListarLugares_Museos(map);
        }

        if (valoresArray.includes('2')) {
            ListarLugares_Playas(map);
        }

        if (valoresArray.includes('3')) {
            ListarLugares_Bares(map);
        }

        if (valoresArray.includes('4')) {
            ListarLugares_Discoteca(map);
        }
        if (valoresArray.includes('5')) {
            ListarLugares_Monumento(map);
        }
        if (valoresArray.includes('6')) {
            ListarLugares_Parques(map);
        }
        if (valoresArray.includes('7')) {
            ListarLugares_Restaurante(map);
        }
        if (valoresArray.includes('8')) {
            ListarLugares_Estacion(map);
        }
        if (valoresArray.includes('9')) {
            ListarLugares_CentroComercial(map);
        }
        if (valoresArray.includes('10')) {
            ListarLugares_Teatro(map);
        }

        var lc = L.control.locate({
            drawCircle: true,
            circleStyle: {
                radius: 200

            }
        }).addTo(map);

        const
            apiKey =
            "AAPK81ad74d3dfd8436fb340536133638fa63ALxp-zis1f4_UJQXProlf6PHzR0q-zOvEnfcnjIbYi2VLIrKWd86ViJHzwjoKVJ";

        const
            apiKey2 =
            "https://nominatim.openstreetmap.org/search?q=1600+Amphitheatre+Parkway,+Mountain+View,+CA&format=json";

        lc.start();
        // darFavorito();
        // Define el �cono que se utilizar� para los marcadores
        var icono = L.icon({
            iconUrl: "{{ asset('img/marcador_teatro.png') }}",
            iconSize: [30, 30], // Tama�o del �cono
            iconAnchor: [15, 30], // Punto de anclaje del �cono
            popupAnchor: [0, -30] // Punto donde se abrir� el popup en relaci�n al �cono
        });

        // Marcador del teatro, PASARLE A LUCA
        // Define el �cono personalizado
        // Define el �cono personalizado en Leaflet utilizando la ruta proporcionada por Laravel con asset()
        var icono_teatro = L.icon({
            iconUrl: "{{ asset('img/marcador_te.jpg') }}", // Ruta de tu imagen de �cono proporcionada por Laravel
            iconSize: [30, 30], // Tama�o del �cono [ancho, alto]
            iconAnchor: [15, 30], // Punto de anclaje del �cono relativo a su posici�n [horizontal, vertical]
            popupAnchor: [0, -30] // Punto donde se abrir� el popup en relaci�n al �cono [horizontal, vertical]
        });


        var icono_playa = L.icon({
            iconUrl: "{{ asset('img/marcador_playa.png') }}", // Ruta de tu imagen de �cono proporcionada por Laravel
            iconSize: [30, 30], // Tama�o del �cono [ancho, alto]
            iconAnchor: [15, 30], // Punto de anclaje del �cono relativo a su posici�n [horizontal, vertical]
            popupAnchor: [0, -30] // Punto donde se abrir� el popup en relaci�n al �cono [horizontal, vertical]
        });


        var icono_museo = L.icon({
            iconUrl: "{{ asset('img/marcador_museo.png') }}", // Ruta de tu imagen de �cono proporcionada por Laravel
            iconSize: [30, 30], // Tama�o del �cono [ancho, alto]
            iconAnchor: [15, 30], // Punto de anclaje del �cono relativo a su posici�n [horizontal, vertical]
            popupAnchor: [0, -30] // Punto donde se abrir� el popup en relaci�n al �cono [horizontal, vertical]
        });

        var icono_bar = L.icon({
            iconUrl: "{{ asset('img/marcador_bar.png') }}", // Ruta de tu imagen de �cono proporcionada por Laravel
            iconSize: [30, 30], // Tama�o del �cono [ancho, alto]
            iconAnchor: [15, 30], // Punto de anclaje del �cono relativo a su posici�n [horizontal, vertical]
            popupAnchor: [0, -30] // Punto donde se abrir� el popup en relaci�n al �cono [horizontal, vertical]
        });


        var icono_parque = L.icon({
            iconUrl: "{{ asset('img/marcador_parque.png') }}", // Ruta de tu imagen de �cono proporcionada por Laravel
            iconSize: [30, 30], // Tama�o del �cono [ancho, alto]
            iconAnchor: [15, 30], // Punto de anclaje del �cono relativo a su posici�n [horizontal, vertical]
            popupAnchor: [0, -30] // Punto donde se abrir� el popup en relaci�n al �cono [horizontal, vertical]
        });


        var icono_discoteca = L.icon({
            iconUrl: "{{ asset('img/marcador_discoteca.png') }}", // Ruta de tu imagen de �cono proporcionada por Laravel
            iconSize: [30, 30], // Tama�o del �cono [ancho, alto]
            iconAnchor: [15, 30], // Punto de anclaje del �cono relativo a su posici�n [horizontal, vertical]
            popupAnchor: [0, -30] // Punto donde se abrir� el popup en relaci�n al �cono [horizontal, vertical]
        });

        var icono_monumento = L.icon({
            iconUrl: "{{ asset('img/marcador_monumento.png') }}", // Ruta de tu imagen de �cono proporcionada por Laravel
            iconSize: [30, 30], // Tama�o del �cono [ancho, alto]
            iconAnchor: [15, 30], // Punto de anclaje del �cono relativo a su posici�n [horizontal, vertical]
            popupAnchor: [0, -30] // Punto donde se abrir� el popup en relaci�n al �cono [horizontal, vertical]
        });


        var icono_restaurante = L.icon({
            iconUrl: "{{ asset('img/marcador_restaurante.png') }}", // Ruta de tu imagen de �cono proporcionada por Laravel
            iconSize: [30, 30], // Tama�o del �cono [ancho, alto]
            iconAnchor: [15, 30], // Punto de anclaje del �cono relativo a su posici�n [horizontal, vertical]
            popupAnchor: [0, -30] // Punto donde se abrir� el popup en relaci�n al �cono [horizontal, vertical]
        });

        var icono_estacion = L.icon({
            iconUrl: "{{ asset('img/marcador_estacion.png') }}", // Ruta de tu imagen de �cono proporcionada por Laravel
            iconSize: [30, 30], // Tama�o del �cono [ancho, alto]
            iconAnchor: [15, 30], // Punto de anclaje del �cono relativo a su posici�n [horizontal, vertical]
            popupAnchor: [0, -30] // Punto donde se abrir� el popup en relaci�n al �cono [horizontal, vertical]
        });

        function ListarLugares_CentroComercial(map) {
            var ajax = new XMLHttpRequest();
            var formdata = new FormData();

            // Agrega el token CSRF al FormData
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formdata.append('_token', csrfToken);

            ajax.open('POST', 'listar_lugares_centros_comerciales');

            ajax.onload = function() {
                if (ajax.status === 200) {
                    var json = JSON.parse(ajax.responseText);
                    var listar_lugares_centros_comerciales = json.listar_lugares_centros_comerciales;

                    if (listar_lugares_centros_comerciales && listar_lugares_centros_comerciales.length > 0) {
                        listar_lugares_centros_comerciales.forEach(function(lugar) {
                            var latitud = parseFloat(lugar.latitud_lug);
                            console.log(latitud)

                            var longitud = parseFloat(lugar.longitud_lug);


                            if (!isNaN(latitud) && !isNaN(longitud)) {
                                var marker = L.marker([latitud, longitud], {
                                    icon: icono
                                }).addTo(map);
                                marker.bindPopup("<div><h2 style='margin-bottom: -20px'>" + lugar
                                    .barrio_lug +
                                    "</h2> <p style='color: grey;margin-bottom: -5px;'>" + lugar
                                    .nombre_lug +
                                    "</p> <hr> <p style='text-align: justify;margin-top: -4px;''>" +
                                    lugar.desc_lug +
                                    "</p><div style='gap: 40%;display: flex; flex-direction: row; justify-content: center; align-items: center;'><button type='button' class='btn_llegar' id='btn_fav' onclick='darFavorito(`" + lugar.id_lug + "`)'" +
                                    lugar.id_lug +
                                    "' value='" + lugar.tipo_lug + "'><i class='fa-solid fa-star'></i></button><span style='left: 12.5%;top: 87%;position: absolute;'>Me Gusta</span><button class='btn_llegar' type='button' name='btn_llegar' id='" + lugar.latitud_lug + "' value='" + lugar.longitud_lug + "' class='btn'><i class='fa-solid fa-diamond-turn-right'></i></button><span style='left: 55%;top: 87%;position: absolute;'>Como llegar</span></div><br>"
                                )
                                // .openPopup();

                                var routingControl
                                marker.on("click", function() {
                                    // console.log("Marker clicked:", lugar.nombre_lug, lugar.barrio_lug,
                                    //     lugar.desc_lug);
                                    var como_llegar = document.getElementsByName("btn_llegar");
                                    console.log(controlOk)
                                    console.log(controlOk2)

                                    if (controlOk === true || controlOk2 === true) {
                                        routingControl.spliceWaypoints(0,
                                            1); // Elimina el marcador de inicio (�ndice 0)
                                        routingControl.spliceWaypoints(routingControl.getWaypoints()
                                            .length - 1,
                                            1); // Elimina el marcador de destino (�ltimo �ndice)

                                        controlOk2 = false;
                                    }
                                    controlOk2 = true;

                                    controlOk = false;

                                    for (let i = 0; i < como_llegar.length; i++) {
                                        como_llegar[i].addEventListener("click", function(evt) {
                                            var latitud = evt.target.id
                                            var longitud = evt.target.value
                                            console.log(latitud)
                                            console.log(longitud)
                                            navigator.geolocation.getCurrentPosition(
                                                function(
                                                    position) {
                                                    var currentLatLng = L.latLng(
                                                        position
                                                        .coords.latitude, position
                                                        .coords.longitude);
                                                    var targetLatLng = L.latLng(latitud,
                                                        longitud);

                                                    routingControl = L.Routing.control({
                                                        waypoints: [
                                                            currentLatLng,
                                                            targetLatLng
                                                        ],
                                                        routeWhileDragging: true,
                                                    }).addTo(map);

                                                    // Agregar un evento al modal para cerrarlo al hacer clic en la cruz de cerrar
                                                    routingControl.on('routingerror',
                                                        function(e) {
                                                            if (e.error.status ===
                                                                200) {
                                                                // Ruta encontrada, cerrar el modal
                                                                // Aqu� puedes agregar el c�digo para cerrar el modal seg�n c�mo est� implementado en tu p�gina
                                                                // Por ejemplo, si est�s usando Bootstrap, puedes cerrar el modal as�:
                                                                // $('#myModal').modal('hide');
                                                            }
                                                        });
                                                });

                                        })
                                    }

                                });
                            } else {
                                console.log("Error: Coordenadas inv�lidas para el lugar:", lugar
                                    .nombre_lug);
                            }
                        });
                    } else {
                        console.log("No se encontraron lugares en la respuesta JSON.");
                    }
                } else {
                    console.log('Error en la solicitud AJAX');
                }
            };

            ajax.onerror = function() {
                console.log("Error en la solicitud AJAX");
            };

            ajax.send(formdata);
        }


        function ListarLugares_Playas(map) {
            var ajax = new XMLHttpRequest();
            var formdata = new FormData();

            // Agrega el token CSRF al FormData
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formdata.append('_token', csrfToken);

            ajax.open('POST', 'listar_lugares_playas');

            ajax.onload = function() {
                if (ajax.status === 200) {
                    var json = JSON.parse(ajax.responseText);
                    var listar_lugares_playas = json.listar_lugares_playas;

                    if (listar_lugares_playas && listar_lugares_playas.length > 0) {
                        listar_lugares_playas.forEach(function(lugar) {
                            var latitud = parseFloat(lugar.latitud_lug);
                            console.log(latitud)

                            var longitud = parseFloat(lugar.longitud_lug);


                            if (!isNaN(latitud) && !isNaN(longitud)) {
                                var marker = L.marker([latitud, longitud], {
                                    icon: icono_playa
                                }).addTo(map);
                                marker.bindPopup("<div><h2 style='margin-bottom: -20px'>" + lugar
                                    .barrio_lug +
                                    "</h2> <p style='color: grey;margin-bottom: -5px;'>" + lugar
                                    .nombre_lug +
                                    "</p> <hr> <p style='text-align: justify;margin-top: -4px;''>" +
                                    lugar.desc_lug +
                                    "</p><div style='gap: 40%;display: flex; flex-direction: row; justify-content: center; align-items: center;'><button type='button' class='btn_llegar' id='btn_fav' onclick='darFavorito(`" + lugar.id_lug + "`)'" +
                                    lugar.id_lug +
                                    "' value='" + lugar.tipo_lug + "'><i class='fa-solid fa-star'></i></button><span style='left: 12.5%;top: 87%;position: absolute;'>Me Gusta</span><button class='btn_llegar' type='button' name='btn_llegar' id='" + lugar.latitud_lug + "' value='" + lugar.longitud_lug + "' class='btn'><i class='fa-solid fa-diamond-turn-right'></i></button><span style='left: 55%;top: 87%;position: absolute;'>Como llegar</span></div><br>"
                                )
                                // .openPopup();

                                var routingControl
                                marker.on("click", function() {
                                    // console.log("Marker clicked:", lugar.nombre_lug, lugar.barrio_lug,
                                    //     lugar.desc_lug);
                                    var como_llegar = document.getElementsByName("btn_llegar");
                                    console.log(controlOk)
                                    console.log(controlOk2)

                                    if (controlOk === true || controlOk2 === true) {
                                        routingControl.spliceWaypoints(0,
                                            1); // Elimina el marcador de inicio (�ndice 0)
                                        routingControl.spliceWaypoints(routingControl.getWaypoints()
                                            .length - 1,
                                            1); // Elimina el marcador de destino (�ltimo �ndice)

                                        controlOk2 = false;
                                    }
                                    controlOk2 = true;

                                    controlOk = false;

                                    for (let i = 0; i < como_llegar.length; i++) {
                                        como_llegar[i].addEventListener("click", function(evt) {
                                            var latitud = evt.target.id
                                            var longitud = evt.target.value
                                            console.log(latitud)
                                            console.log(longitud)
                                            navigator.geolocation.getCurrentPosition(
                                                function(
                                                    position) {
                                                    var currentLatLng = L.latLng(
                                                        position
                                                        .coords.latitude, position
                                                        .coords.longitude);
                                                    var targetLatLng = L.latLng(latitud,
                                                        longitud);

                                                    routingControl = L.Routing.control({
                                                        waypoints: [
                                                            currentLatLng,
                                                            targetLatLng
                                                        ],
                                                        routeWhileDragging: true,
                                                    }).addTo(map);

                                                    // Agregar un evento al modal para cerrarlo al hacer clic en la cruz de cerrar
                                                    routingControl.on('routingerror',
                                                        function(e) {
                                                            if (e.error.status ===
                                                                200) {
                                                                // Ruta encontrada, cerrar el modal
                                                                // Aqu� puedes agregar el c�digo para cerrar el modal seg�n c�mo est� implementado en tu p�gina
                                                                // Por ejemplo, si est�s usando Bootstrap, puedes cerrar el modal as�:
                                                                // $('#myModal').modal('hide');
                                                            }
                                                        });
                                                });

                                        })
                                    }

                                });
                            } else {
                                console.log("Error: Coordenadas inv�lidas para el lugar:", lugar
                                    .nombre_lug);
                            }
                        });
                    } else {
                        console.log("No se encontraron lugares en la respuesta JSON.");
                    }
                } else {
                    console.log('Error en la solicitud AJAX');
                }
            };

            ajax.onerror = function() {
                console.log("Error en la solicitud AJAX");
            };

            ajax.send(formdata);
        }







        function ListarLugares_Museos(map) {
            var ajax = new XMLHttpRequest();
            var formdata = new FormData();

            // Agrega el token CSRF al FormData
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formdata.append('_token', csrfToken);

            ajax.open('POST', 'listar_lugares_museos');

            ajax.onload = function() {
                if (ajax.status === 200) {
                    var json = JSON.parse(ajax.responseText);
                    var listar_lugares_museos = json.listar_lugares_museos;

                    if (listar_lugares_museos && listar_lugares_museos.length > 0) {
                        listar_lugares_museos.forEach(function(lugar) {
                            var latitud = parseFloat(lugar.latitud_lug);
                            console.log(latitud)

                            var longitud = parseFloat(lugar.longitud_lug);


                            if (!isNaN(latitud) && !isNaN(longitud)) {
                                var marker = L.marker([latitud, longitud], {
                                    icon: icono_museo
                                }).addTo(map);
                                marker.bindPopup("<div><h2 style='margin-bottom: -20px'>" + lugar
                                    .barrio_lug +
                                    "</h2> <p style='color: grey;margin-bottom: -5px;'>" + lugar
                                    .nombre_lug +
                                    "</p> <hr> <p style='text-align: justify;margin-top: -4px;''>" +
                                    lugar.desc_lug +
                                    "</p><div style='gap: 40%;display: flex; flex-direction: row; justify-content: center; align-items: center;'><button type='button' class='btn_llegar' id='btn_fav' onclick='darFavorito(`" + lugar.id_lug + "`)'" +
                                    lugar.id_lug +
                                    "' value='" + lugar.tipo_lug + "'><i class='fa-solid fa-star'></i></button><span style='left: 12.5%;top: 87%;position: absolute;'>Me Gusta</span><button class='btn_llegar' type='button' name='btn_llegar' id='" + lugar.latitud_lug + "' value='" + lugar.longitud_lug + "' class='btn'><i class='fa-solid fa-diamond-turn-right'></i></button><span style='left: 55%;top: 87%;position: absolute;'>Como llegar</span></div><br>"
                                )
                                // .openPopup();

                                var routingControl
                                marker.on("click", function() {
                                    // console.log("Marker clicked:", lugar.nombre_lug, lugar.barrio_lug,
                                    //     lugar.desc_lug);
                                    var como_llegar = document.getElementsByName("btn_llegar");
                                    console.log(controlOk)
                                    console.log(controlOk2)

                                    if (controlOk === true || controlOk2 === true) {
                                        routingControl.spliceWaypoints(0,
                                            1); // Elimina el marcador de inicio (�ndice 0)
                                        routingControl.spliceWaypoints(routingControl.getWaypoints()
                                            .length - 1,
                                            1); // Elimina el marcador de destino (�ltimo �ndice)

                                        controlOk2 = false;
                                    }
                                    controlOk2 = true;

                                    controlOk = false;

                                    for (let i = 0; i < como_llegar.length; i++) {
                                        como_llegar[i].addEventListener("click", function(evt) {
                                            var latitud = evt.target.id
                                            var longitud = evt.target.value
                                            console.log(latitud)
                                            console.log(longitud)
                                            navigator.geolocation.getCurrentPosition(
                                                function(
                                                    position) {
                                                    var currentLatLng = L.latLng(
                                                        position
                                                        .coords.latitude, position
                                                        .coords.longitude);
                                                    var targetLatLng = L.latLng(latitud,
                                                        longitud);

                                                    routingControl = L.Routing.control({
                                                        waypoints: [
                                                            currentLatLng,
                                                            targetLatLng
                                                        ],
                                                        routeWhileDragging: true,
                                                    }).addTo(map);

                                                    // Agregar un evento al modal para cerrarlo al hacer clic en la cruz de cerrar
                                                    routingControl.on('routingerror',
                                                        function(e) {
                                                            if (e.error.status ===
                                                                200) {
                                                                // Ruta encontrada, cerrar el modal
                                                                // Aqu� puedes agregar el c�digo para cerrar el modal seg�n c�mo est� implementado en tu p�gina
                                                                // Por ejemplo, si est�s usando Bootstrap, puedes cerrar el modal as�:
                                                                // $('#myModal').modal('hide');
                                                            }
                                                        });
                                                });

                                        })
                                    }

                                });
                            } else {
                                console.log("Error: Coordenadas inv�lidas para el lugar:", lugar
                                    .nombre_lug);
                            }
                        });
                    } else {
                        console.log("No se encontraron lugares en la respuesta JSON.");
                    }
                } else {
                    console.log('Error en la solicitud AJAX');
                }
            };

            ajax.onerror = function() {
                console.log("Error en la solicitud AJAX");
            };

            ajax.send(formdata);
        }




function darFavorito(id) {
            var ajax = new XMLHttpRequest();
            var formdata = new FormData();

            // Agrega el token CSRF al FormData
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formdata.append('_token', csrfToken);
            formdata.append('id_lugar', id);

            ajax.open('POST', 'anadir_like');

            ajax.onload = function() {
                if (ajax.status === 200) {
                    console.log(ajax.responseText);

                    try {
                        var resultado = JSON.parse(ajax.responseText);
                        console.log(resultado); // Mostrar la respuesta JSON en la consola

                        if (resultado === 'ok') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Has dado favorito',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else if (resultado === 'no') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Has borrado el favorito',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                        mostrarFavoritos();
                    } catch (error) {
                        console.error('Error al parsear la respuesta JSON:', error);
                    }
                } else {
                    console.error('Error al realizar la solicitud:', ajax.status);
                }
            };

            ajax.onerror = function() {
                console.error('Error en la solicitud AJAX');
            };

            ajax.send(formdata);
        }

        function ListarLugares_Bares(map) {
            var ajax = new XMLHttpRequest();
            var formdata = new FormData();

            // Agrega el token CSRF al FormData
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formdata.append('_token', csrfToken);

            ajax.open('POST', 'listar_lugares_bares');

            ajax.onload = function() {
                if (ajax.status === 200) {
                    var json = JSON.parse(ajax.responseText);
                    var listar_lugares_bares = json.listar_lugares_bares;

                    if (listar_lugares_bares && listar_lugares_bares.length > 0) {
                        listar_lugares_bares.forEach(function(lugar) {
                            var latitud = parseFloat(lugar.latitud_lug);
                            console.log(latitud)

                            var longitud = parseFloat(lugar.longitud_lug);


                            if (!isNaN(latitud) && !isNaN(longitud)) {
                                var marker = L.marker([latitud, longitud], {
                                    icon: icono_bar
                                }).addTo(map);
                                marker.bindPopup("<div><h2 style='margin-bottom: -20px'>" + lugar
                                    .barrio_lug +
                                    "</h2> <p style='color: grey;margin-bottom: -5px;'>" + lugar
                                    .nombre_lug +
                                    "</p> <hr> <p style='text-align: justify;margin-top: -4px;''>" +
                                    lugar.desc_lug +
                                    "</p><div style='gap: 40%;display: flex; flex-direction: row; justify-content: center; align-items: center;'><button type='button' class='btn_llegar' id='btn_fav' onclick='darFavorito(`" + lugar.id_lug + "`)'" +
                                    lugar.id_lug +
                                    "' value='" + lugar.tipo_lug + "'><i class='fa-solid fa-star'></i></button><span style='left: 12.5%;top: 87%;position: absolute;'>Me Gusta</span><button class='btn_llegar' type='button' name='btn_llegar' id='" + lugar.latitud_lug + "' value='" + lugar.longitud_lug + "' class='btn'><i class='fa-solid fa-diamond-turn-right'></i></button><span style='left: 55%;top: 87%;position: absolute;'>Como llegar</span></div><br>"
                                )
                                // .openPopup();

                                var routingControl
                                marker.on("click", function() {
                                    // console.log("Marker clicked:", lugar.nombre_lug, lugar.barrio_lug,
                                    //     lugar.desc_lug);
                                    var como_llegar = document.getElementsByName("btn_llegar");
                                    console.log(controlOk)
                                    console.log(controlOk2)

                                    if (controlOk === true || controlOk2 === true) {
                                        routingControl.spliceWaypoints(0,
                                            1); // Elimina el marcador de inicio (�ndice 0)
                                        routingControl.spliceWaypoints(routingControl.getWaypoints()
                                            .length - 1,
                                            1); // Elimina el marcador de destino (�ltimo �ndice)

                                        controlOk2 = false;
                                    }
                                    controlOk2 = true;

                                    controlOk = false;

                                    for (let i = 0; i < como_llegar.length; i++) {
                                        como_llegar[i].addEventListener("click", function(evt) {
                                            var latitud = evt.target.id
                                            var longitud = evt.target.value
                                            console.log(latitud)
                                            console.log(longitud)
                                            navigator.geolocation.getCurrentPosition(
                                                function(
                                                    position) {
                                                    var currentLatLng = L.latLng(
                                                        position
                                                        .coords.latitude, position
                                                        .coords.longitude);
                                                    var targetLatLng = L.latLng(latitud,
                                                        longitud);

                                                    routingControl = L.Routing.control({
                                                        waypoints: [
                                                            currentLatLng,
                                                            targetLatLng
                                                        ],
                                                        routeWhileDragging: true,
                                                    }).addTo(map);

                                                    // Agregar un evento al modal para cerrarlo al hacer clic en la cruz de cerrar
                                                    routingControl.on('routingerror',
                                                        function(e) {
                                                            if (e.error.status ===
                                                                200) {
                                                                // Ruta encontrada, cerrar el modal
                                                                // Aqu� puedes agregar el c�digo para cerrar el modal seg�n c�mo est� implementado en tu p�gina
                                                                // Por ejemplo, si est�s usando Bootstrap, puedes cerrar el modal as�:
                                                                // $('#myModal').modal('hide');
                                                            }
                                                        });
                                                });

                                        })
                                    }

                                });
                            } else {
                                console.log("Error: Coordenadas inv�lidas para el lugar:", lugar
                                    .nombre_lug);
                            }
                        });
                    } else {
                        console.log("No se encontraron lugares en la respuesta JSON.");
                    }
                } else {
                    console.log('Error en la solicitud AJAX');
                }
            };

            ajax.onerror = function() {
                console.log("Error en la solicitud AJAX");
            };

            ajax.send(formdata);
        }








        function ListarLugares_Parques(map) {
            var ajax = new XMLHttpRequest();
            var formdata = new FormData();

            // Agrega el token CSRF al FormData
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formdata.append('_token', csrfToken);

            ajax.open('POST', 'listar_lugares_parques');

            ajax.onload = function() {
                if (ajax.status === 200) {
                    var json = JSON.parse(ajax.responseText);
                    var listar_lugares_parques = json.listar_lugares_parques;

                    if (listar_lugares_parques && listar_lugares_parques.length > 0) {
                        listar_lugares_parques.forEach(function(lugar) {
                            var latitud = parseFloat(lugar.latitud_lug);
                            console.log(latitud)

                            var longitud = parseFloat(lugar.longitud_lug);


                            if (!isNaN(latitud) && !isNaN(longitud)) {
                                var marker = L.marker([latitud, longitud], {
                                    icon: icono_parque
                                }).addTo(map);
                                marker.bindPopup("<div><h2 style='margin-bottom: -20px'>" + lugar
                                    .barrio_lug +
                                    "</h2> <p style='color: grey;margin-bottom: -5px;'>" + lugar
                                    .nombre_lug +
                                    "</p> <hr> <p style='text-align: justify;margin-top: -4px;''>" +
                                    lugar.desc_lug +
                                    "</p><div style='gap: 40%;display: flex; flex-direction: row; justify-content: center; align-items: center;'><button type='button' class='btn_llegar' id='btn_fav' onclick='darFavorito(`" + lugar.id_lug + "`)'" +
                                    lugar.id_lug +
                                    "' value='" + lugar.tipo_lug + "'><i class='fa-solid fa-star'></i></button><span style='left: 12.5%;top: 87%;position: absolute;'>Me Gusta</span><button class='btn_llegar' type='button' name='btn_llegar' id='" + lugar.latitud_lug + "' value='" + lugar.longitud_lug + "' class='btn'><i class='fa-solid fa-diamond-turn-right'></i></button><span style='left: 55%;top: 87%;position: absolute;'>Como llegar</span></div><br>"
                                )
                                // .openPopup();

                                var routingControl
                                marker.on("click", function() {
                                    // console.log("Marker clicked:", lugar.nombre_lug, lugar.barrio_lug,
                                    //     lugar.desc_lug);
                                    var como_llegar = document.getElementsByName("btn_llegar");
                                    console.log(controlOk)
                                    console.log(controlOk2)

                                    if (controlOk === true || controlOk2 === true) {
                                        routingControl.spliceWaypoints(0,
                                            1); // Elimina el marcador de inicio (�ndice 0)
                                        routingControl.spliceWaypoints(routingControl.getWaypoints()
                                            .length - 1,
                                            1); // Elimina el marcador de destino (�ltimo �ndice)

                                        controlOk2 = false;
                                    }
                                    controlOk2 = true;

                                    controlOk = false;

                                    for (let i = 0; i < como_llegar.length; i++) {
                                        como_llegar[i].addEventListener("click", function(evt) {
                                            var latitud = evt.target.id
                                            var longitud = evt.target.value
                                            console.log(latitud)
                                            console.log(longitud)
                                            navigator.geolocation.getCurrentPosition(
                                                function(
                                                    position) {
                                                    var currentLatLng = L.latLng(
                                                        position
                                                        .coords.latitude, position
                                                        .coords.longitude);
                                                    var targetLatLng = L.latLng(latitud,
                                                        longitud);

                                                    routingControl = L.Routing.control({
                                                        waypoints: [
                                                            currentLatLng,
                                                            targetLatLng
                                                        ],
                                                        routeWhileDragging: true,
                                                    }).addTo(map);

                                                    // Agregar un evento al modal para cerrarlo al hacer clic en la cruz de cerrar
                                                    routingControl.on('routingerror',
                                                        function(e) {
                                                            if (e.error.status ===
                                                                200) {
                                                                // Ruta encontrada, cerrar el modal
                                                                // Aqu� puedes agregar el c�digo para cerrar el modal seg�n c�mo est� implementado en tu p�gina
                                                                // Por ejemplo, si est�s usando Bootstrap, puedes cerrar el modal as�:
                                                                // $('#myModal').modal('hide');
                                                            }
                                                        });
                                                });

                                        })
                                    }

                                });
                            } else {
                                console.log("Error: Coordenadas inv�lidas para el lugar:", lugar
                                    .nombre_lug);
                            }
                        });
                    } else {
                        console.log("No se encontraron lugares en la respuesta JSON.");
                    }
                } else {
                    console.log('Error en la solicitud AJAX');
                }
            };

            ajax.onerror = function() {
                console.log("Error en la solicitud AJAX");
            };

            ajax.send(formdata);
        }




        function ListarLugares_Discoteca(map) {
            var ajax = new XMLHttpRequest();
            var formdata = new FormData();

            // Agrega el token CSRF al FormData
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formdata.append('_token', csrfToken);

            ajax.open('POST', 'listar_lugares_discotecas');

            ajax.onload = function() {
                if (ajax.status === 200) {
                    var json = JSON.parse(ajax.responseText);
                    var listar_lugares_discotecas = json.listar_lugares_discotecas;

                    if (listar_lugares_discotecas && listar_lugares_discotecas.length > 0) {
                        listar_lugares_discotecas.forEach(function(lugar) {
                            var latitud = parseFloat(lugar.latitud_lug);
                            console.log(latitud)

                            var longitud = parseFloat(lugar.longitud_lug);


                            if (!isNaN(latitud) && !isNaN(longitud)) {
                                var marker = L.marker([latitud, longitud], {
                                    icon: icono_discoteca
                                }).addTo(map);
                                marker.bindPopup("<div><h2 style='margin-bottom: -20px'>" + lugar
                                    .barrio_lug +
                                    "</h2> <p style='color: grey;margin-bottom: -5px;'>" + lugar
                                    .nombre_lug +
                                    "</p> <hr> <p style='text-align: justify;margin-top: -4px;''>" +
                                    lugar.desc_lug +
                                    "</p><div style='gap: 40%;display: flex; flex-direction: row; justify-content: center; align-items: center;'><button type='button' class='btn_llegar' id='btn_fav' onclick='darFavorito(`" + lugar.id_lug + "`)'" +
                                    lugar.id_lug +
                                    "' value='" + lugar.tipo_lug + "'><i class='fa-solid fa-star'></i></button><span style='left: 12.5%;top: 87%;position: absolute;'>Me Gusta</span><button class='btn_llegar' type='button' name='btn_llegar' id='" + lugar.latitud_lug + "' value='" + lugar.longitud_lug + "' class='btn'><i class='fa-solid fa-diamond-turn-right'></i></button><span style='left: 55%;top: 87%;position: absolute;'>Como llegar</span></div><br>"
                                )
                                // .openPopup();

                                var routingControl
                                marker.on("click", function() {
                                    // console.log("Marker clicked:", lugar.nombre_lug, lugar.barrio_lug,
                                    //     lugar.desc_lug);
                                    var como_llegar = document.getElementsByName("btn_llegar");
                                    console.log(controlOk)
                                    console.log(controlOk2)

                                    if (controlOk === true || controlOk2 === true) {
                                        routingControl.spliceWaypoints(0,
                                            1); // Elimina el marcador de inicio (�ndice 0)
                                        routingControl.spliceWaypoints(routingControl.getWaypoints()
                                            .length - 1,
                                            1); // Elimina el marcador de destino (�ltimo �ndice)

                                        controlOk2 = false;
                                    }
                                    controlOk2 = true;

                                    controlOk = false;

                                    for (let i = 0; i < como_llegar.length; i++) {
                                        como_llegar[i].addEventListener("click", function(evt) {
                                            var latitud = evt.target.id
                                            var longitud = evt.target.value
                                            console.log(latitud)
                                            console.log(longitud)
                                            navigator.geolocation.getCurrentPosition(
                                                function(
                                                    position) {
                                                    var currentLatLng = L.latLng(
                                                        position
                                                        .coords.latitude, position
                                                        .coords.longitude);
                                                    var targetLatLng = L.latLng(latitud,
                                                        longitud);

                                                    routingControl = L.Routing.control({
                                                        waypoints: [
                                                            currentLatLng,
                                                            targetLatLng
                                                        ],
                                                        routeWhileDragging: true,
                                                    }).addTo(map);

                                                    // Agregar un evento al modal para cerrarlo al hacer clic en la cruz de cerrar
                                                    routingControl.on('routingerror',
                                                        function(e) {
                                                            if (e.error.status ===
                                                                200) {
                                                                // Ruta encontrada, cerrar el modal
                                                                // Aqu� puedes agregar el c�digo para cerrar el modal seg�n c�mo est� implementado en tu p�gina
                                                                // Por ejemplo, si est�s usando Bootstrap, puedes cerrar el modal as�:
                                                                // $('#myModal').modal('hide');
                                                            }
                                                        });
                                                });

                                        })
                                    }

                                });
                            } else {
                                console.log("Error: Coordenadas inv�lidas para el lugar:", lugar
                                    .nombre_lug);
                            }
                        });
                    } else {
                        console.log("No se encontraron lugares en la respuesta JSON.");
                    }
                } else {
                    console.log('Error en la solicitud AJAX');
                }
            };

            ajax.onerror = function() {
                console.log("Error en la solicitud AJAX");
            };

            ajax.send(formdata);
        }




        function ListarLugares_Monumento(map) {
            var ajax = new XMLHttpRequest();
            var formdata = new FormData();

            // Agrega el token CSRF al FormData
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formdata.append('_token', csrfToken);

            ajax.open('POST', 'listar_lugares_monumentos');

            ajax.onload = function() {
                if (ajax.status === 200) {
                    var json = JSON.parse(ajax.responseText);
                    var listar_lugares_monumentos = json.listar_lugares_monumentos;

                    if (listar_lugares_monumentos && listar_lugares_monumentos.length > 0) {
                        listar_lugares_monumentos.forEach(function(lugar) {
                            var latitud = parseFloat(lugar.latitud_lug);
                            console.log(latitud)

                            var longitud = parseFloat(lugar.longitud_lug);


                            if (!isNaN(latitud) && !isNaN(longitud)) {
                                var marker = L.marker([latitud, longitud], {
                                    icon: icono_monumento
                                }).addTo(map);
                                marker.bindPopup("<div><h2 style='margin-bottom: -20px'>" + lugar
                                    .barrio_lug +
                                    "</h2> <p style='color: grey;margin-bottom: -5px;'>" + lugar
                                    .nombre_lug +
                                    "</p> <hr> <p style='text-align: justify;margin-top: -4px;''>" +
                                    lugar.desc_lug +
                                    "</p><div style='gap: 40%;display: flex; flex-direction: row; justify-content: center; align-items: center;'><button type='button' class='btn_llegar' id='btn_fav' onclick='darFavorito(`" + lugar.id_lug + "`)'" +
                                    lugar.id_lug +
                                    "' value='" + lugar.tipo_lug + "'><i class='fa-solid fa-star'></i></button><span style='left: 12.5%;top: 87%;position: absolute;'>Me Gusta</span><button class='btn_llegar' type='button' name='btn_llegar' id='" + lugar.latitud_lug + "' value='" + lugar.longitud_lug + "' class='btn'><i class='fa-solid fa-diamond-turn-right'></i></button><span style='left: 55%;top: 87%;position: absolute;'>Como llegar</span></div><br>"
                                )
                                // .openPopup();

                                var routingControl
                                marker.on("click", function() {
                                    // console.log("Marker clicked:", lugar.nombre_lug, lugar.barrio_lug,
                                    //     lugar.desc_lug);
                                    var como_llegar = document.getElementsByName("btn_llegar");
                                    console.log(controlOk)
                                    console.log(controlOk2)

                                    if (controlOk === true || controlOk2 === true) {
                                        routingControl.spliceWaypoints(0,
                                            1); // Elimina el marcador de inicio (�ndice 0)
                                        routingControl.spliceWaypoints(routingControl.getWaypoints()
                                            .length - 1,
                                            1); // Elimina el marcador de destino (�ltimo �ndice)

                                        controlOk2 = false;
                                    }
                                    controlOk2 = true;

                                    controlOk = false;

                                    for (let i = 0; i < como_llegar.length; i++) {
                                        como_llegar[i].addEventListener("click", function(evt) {
                                            var latitud = evt.target.id
                                            var longitud = evt.target.value
                                            console.log(latitud)
                                            console.log(longitud)
                                            navigator.geolocation.getCurrentPosition(
                                                function(
                                                    position) {
                                                    var currentLatLng = L.latLng(
                                                        position
                                                        .coords.latitude, position
                                                        .coords.longitude);
                                                    var targetLatLng = L.latLng(latitud,
                                                        longitud);

                                                    routingControl = L.Routing.control({
                                                        waypoints: [
                                                            currentLatLng,
                                                            targetLatLng
                                                        ],
                                                        routeWhileDragging: true,
                                                    }).addTo(map);

                                                    // Agregar un evento al modal para cerrarlo al hacer clic en la cruz de cerrar
                                                    routingControl.on('routingerror',
                                                        function(e) {
                                                            if (e.error.status ===
                                                                200) {
                                                                // Ruta encontrada, cerrar el modal
                                                                // Aqu� puedes agregar el c�digo para cerrar el modal seg�n c�mo est� implementado en tu p�gina
                                                                // Por ejemplo, si est�s usando Bootstrap, puedes cerrar el modal as�:
                                                                // $('#myModal').modal('hide');
                                                            }
                                                        });
                                                });

                                        })
                                    }

                                });
                            } else {
                                console.log("Error: Coordenadas inv�lidas para el lugar:", lugar
                                    .nombre_lug);
                            }
                        });
                    } else {
                        console.log("No se encontraron lugares en la respuesta JSON.");
                    }
                } else {
                    console.log('Error en la solicitud AJAX');
                }
            };

            ajax.onerror = function() {
                console.log("Error en la solicitud AJAX");
            };

            ajax.send(formdata);
        }




        function ListarLugares_Restaurante(map) {
            var ajax = new XMLHttpRequest();
            var formdata = new FormData();

            // Agrega el token CSRF al FormData
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formdata.append('_token', csrfToken);

            ajax.open('POST', 'listar_lugares_restaurante');

            ajax.onload = function() {
                if (ajax.status === 200) {
                    var json = JSON.parse(ajax.responseText);
                    var listar_lugares_restaurante = json.listar_lugares_restaurante;

                    if (listar_lugares_restaurante && listar_lugares_restaurante.length > 0) {
                        listar_lugares_restaurante.forEach(function(lugar) {
                            var latitud = parseFloat(lugar.latitud_lug);
                            console.log(latitud)

                            var longitud = parseFloat(lugar.longitud_lug);


                            if (!isNaN(latitud) && !isNaN(longitud)) {
                                var marker = L.marker([latitud, longitud], {
                                    icon: icono_restaurante
                                }).addTo(map);
                                marker.bindPopup("<div><h2 style='margin-bottom: -20px'>" + lugar
                                    .barrio_lug +
                                    "</h2> <p style='color: grey;margin-bottom: -5px;'>" + lugar
                                    .nombre_lug +
                                    "</p> <hr> <p style='text-align: justify;margin-top: -4px;''>" +
                                    lugar.desc_lug +
                                    "</p><div style='gap: 40%;display: flex; flex-direction: row; justify-content: center; align-items: center;'><button type='button' class='btn_llegar' id='btn_fav' onclick='darFavorito(`" + lugar.id_lug + "`)'" +
                                    lugar.id_lug +
                                    "' value='" + lugar.tipo_lug + "'><i class='fa-solid fa-star'></i></button><span style='left: 12.5%;top: 87%;position: absolute;'>Me Gusta</span><button class='btn_llegar' type='button' name='btn_llegar' id='" + lugar.latitud_lug + "' value='" + lugar.longitud_lug + "' class='btn'><i class='fa-solid fa-diamond-turn-right'></i></button><span style='left: 55%;top: 87%;position: absolute;'>Como llegar</span></div><br>"
                                )
                                // .openPopup();

                                var routingControl
                                marker.on("click", function() {
                                    // console.log("Marker clicked:", lugar.nombre_lug, lugar.barrio_lug,
                                    //     lugar.desc_lug);
                                    var como_llegar = document.getElementsByName("btn_llegar");
                                    console.log(controlOk)
                                    console.log(controlOk2)

                                    if (controlOk === true || controlOk2 === true) {
                                        routingControl.spliceWaypoints(0,
                                            1); // Elimina el marcador de inicio (�ndice 0)
                                        routingControl.spliceWaypoints(routingControl.getWaypoints()
                                            .length - 1,
                                            1); // Elimina el marcador de destino (�ltimo �ndice)

                                        controlOk2 = false;
                                    }
                                    controlOk2 = true;

                                    controlOk = false;

                                    for (let i = 0; i < como_llegar.length; i++) {
                                        como_llegar[i].addEventListener("click", function(evt) {
                                            var latitud = evt.target.id
                                            var longitud = evt.target.value
                                            console.log(latitud)
                                            console.log(longitud)
                                            navigator.geolocation.getCurrentPosition(
                                                function(
                                                    position) {
                                                    var currentLatLng = L.latLng(
                                                        position
                                                        .coords.latitude, position
                                                        .coords.longitude);
                                                    var targetLatLng = L.latLng(latitud,
                                                        longitud);

                                                    routingControl = L.Routing.control({
                                                        waypoints: [
                                                            currentLatLng,
                                                            targetLatLng
                                                        ],
                                                        routeWhileDragging: true,
                                                    }).addTo(map);

                                                    // Agregar un evento al modal para cerrarlo al hacer clic en la cruz de cerrar
                                                    routingControl.on('routingerror',
                                                        function(e) {
                                                            if (e.error.status ===
                                                                200) {
                                                                // Ruta encontrada, cerrar el modal
                                                                // Aqu� puedes agregar el c�digo para cerrar el modal seg�n c�mo est� implementado en tu p�gina
                                                                // Por ejemplo, si est�s usando Bootstrap, puedes cerrar el modal as�:
                                                                // $('#myModal').modal('hide');
                                                            }
                                                        });
                                                });

                                        })
                                    }

                                });
                            } else {
                                console.log("Error: Coordenadas inv�lidas para el lugar:", lugar
                                    .nombre_lug);
                            }
                        });
                    } else {
                        console.log("No se encontraron lugares en la respuesta JSON.");
                    }
                } else {
                    console.log('Error en la solicitud AJAX');
                }
            };

            ajax.onerror = function() {
                console.log("Error en la solicitud AJAX");
            };

            ajax.send(formdata);
        }




        function ListarLugares_Estacion(map) {
            var ajax = new XMLHttpRequest();
            var formdata = new FormData();

            // Agrega el token CSRF al FormData
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formdata.append('_token', csrfToken);

            ajax.open('POST', 'listar_lugares_estacion');

            ajax.onload = function() {
                if (ajax.status === 200) {
                    var json = JSON.parse(ajax.responseText);
                    var listar_lugares_estacion = json.listar_lugares_estacion;

                    if (listar_lugares_estacion && listar_lugares_estacion.length > 0) {
                        listar_lugares_estacion.forEach(function(lugar) {
                            var latitud = parseFloat(lugar.latitud_lug);
                            console.log(latitud)

                            var longitud = parseFloat(lugar.longitud_lug);


                            if (!isNaN(latitud) && !isNaN(longitud)) {
                                var marker = L.marker([latitud, longitud], {
                                    icon: icono_estacion
                                }).addTo(map);
                                marker.bindPopup("<div><h2 style='margin-bottom: -20px'>" + lugar
                                    .barrio_lug +
                                    "</h2> <p style='color: grey;margin-bottom: -5px;'>" + lugar
                                    .nombre_lug +
                                    "</p> <hr> <p style='text-align: justify;margin-top: -4px;''>" +
                                    lugar.desc_lug +
                                    "</p><div style='gap: 40%;display: flex; flex-direction: row; justify-content: center; align-items: center;'><button type='button' class='btn_llegar' id='btn_fav' onclick='darFavorito(`" + lugar.id_lug + "`)'" +
                                    lugar.id_lug +
                                    "' value='" + lugar.tipo_lug + "'><i class='fa-solid fa-star'></i></button><span style='left: 12.5%;top: 87%;position: absolute;'>Me Gusta</span><button class='btn_llegar' type='button' name='btn_llegar' id='" + lugar.latitud_lug + "' value='" + lugar.longitud_lug + "' class='btn'><i class='fa-solid fa-diamond-turn-right'></i></button><span style='left: 55%;top: 87%;position: absolute;'>Como llegar</span></div><br>"
                                )
                                // .openPopup();

                                var routingControl
                                marker.on("click", function() {
                                    // console.log("Marker clicked:", lugar.nombre_lug, lugar.barrio_lug,
                                    //     lugar.desc_lug);
                                    var como_llegar = document.getElementsByName("btn_llegar");
                                    console.log(controlOk)
                                    console.log(controlOk2)

                                    if (controlOk === true || controlOk2 === true) {
                                        routingControl.spliceWaypoints(0,
                                            1); // Elimina el marcador de inicio (�ndice 0)
                                        routingControl.spliceWaypoints(routingControl.getWaypoints()
                                            .length - 1,
                                            1); // Elimina el marcador de destino (�ltimo �ndice)

                                        controlOk2 = false;
                                    }
                                    controlOk2 = true;

                                    controlOk = false;

                                    for (let i = 0; i < como_llegar.length; i++) {
                                        como_llegar[i].addEventListener("click", function(evt) {
                                            var latitud = evt.target.id
                                            var longitud = evt.target.value
                                            console.log(latitud)
                                            console.log(longitud)
                                            navigator.geolocation.getCurrentPosition(
                                                function(
                                                    position) {
                                                    var currentLatLng = L.latLng(
                                                        position
                                                        .coords.latitude, position
                                                        .coords.longitude);
                                                    var targetLatLng = L.latLng(latitud,
                                                        longitud);

                                                    routingControl = L.Routing.control({
                                                        waypoints: [
                                                            currentLatLng,
                                                            targetLatLng
                                                        ],
                                                        routeWhileDragging: true,
                                                    }).addTo(map);

                                                    // Agregar un evento al modal para cerrarlo al hacer clic en la cruz de cerrar
                                                    routingControl.on('routingerror',
                                                        function(e) {
                                                            if (e.error.status ===
                                                                200) {
                                                                // Ruta encontrada, cerrar el modal
                                                                // Aqu� puedes agregar el c�digo para cerrar el modal seg�n c�mo est� implementado en tu p�gina
                                                                // Por ejemplo, si est�s usando Bootstrap, puedes cerrar el modal as�:
                                                                // $('#myModal').modal('hide');
                                                            }
                                                        });
                                                });

                                        })
                                    }

                                });
                            } else {
                                console.log("Error: Coordenadas inv�lidas para el lugar:", lugar
                                    .nombre_lug);
                            }
                        });
                    } else {
                        console.log("No se encontraron lugares en la respuesta JSON.");
                    }
                } else {
                    console.log('Error en la solicitud AJAX');
                }
            };

            ajax.onerror = function() {
                console.log("Error en la solicitud AJAX");
            };

            ajax.send(formdata);
        }






        function ListarLugares_Teatro(map) {
            var ajax = new XMLHttpRequest();
            var formdata = new FormData();

            // Agrega el token CSRF al FormData
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formdata.append('_token', csrfToken);

            ajax.open('POST', 'listar_lugares_teatro');

            ajax.onload = function() {
                if (ajax.status === 200) {
                    var json = JSON.parse(ajax.responseText);
                    var listar_lugares_teatro = json.listar_lugares_teatro;

                    if (listar_lugares_teatro && listar_lugares_teatro.length > 0) {
                        listar_lugares_teatro.forEach(function(lugar) {
                            var latitud = parseFloat(lugar.latitud_lug);
                            console.log(latitud)

                            var longitud = parseFloat(lugar.longitud_lug);


                            if (!isNaN(latitud) && !isNaN(longitud)) {
                                var marker = L.marker([latitud, longitud], {
                                    icon: icono
                                }).addTo(map);
                                marker.bindPopup("<div><h2 style='margin-bottom: -20px'>" + lugar
                                    .barrio_lug +
                                    "</h2> <p style='color: grey;margin-bottom: -5px;'>" + lugar
                                    .nombre_lug +
                                    "</p> <hr> <p style='text-align: justify;margin-top: -4px;''>" +
                                    lugar.desc_lug +
                                    "</p><div style='gap: 40%;display: flex; flex-direction: row; justify-content: center; align-items: center;'><button type='button' class='btn_llegar' id='btn_fav' onclick='darFavorito(`" + lugar.id_lug + "`)'" +
                                    lugar.id_lug +
                                    "' value='" + lugar.tipo_lug + "'><i class='fa-solid fa-star'></i></button><span style='left: 12.5%;top: 87%;position: absolute;'>Me Gusta</span><button class='btn_llegar' type='button' name='btn_llegar' id='" + lugar.latitud_lug + "' value='" + lugar.longitud_lug + "' class='btn'><i class='fa-solid fa-diamond-turn-right'></i></button><span style='left: 55%;top: 87%;position: absolute;'>Como llegar</span></div><br>"
                                )
                                // .openPopup();

                                var routingControl
                                marker.on("click", function() {
                                    // console.log("Marker clicked:", lugar.nombre_lug, lugar.barrio_lug,
                                    //     lugar.desc_lug);
                                    var como_llegar = document.getElementsByName("btn_llegar");
                                    console.log(controlOk)
                                    console.log(controlOk2)

                                    if (controlOk === true || controlOk2 === true) {
                                        routingControl.spliceWaypoints(0,
                                            1); // Elimina el marcador de inicio (�ndice 0)
                                        routingControl.spliceWaypoints(routingControl.getWaypoints()
                                            .length - 1,
                                            1); // Elimina el marcador de destino (�ltimo �ndice)

                                        controlOk2 = false;
                                    }
                                    controlOk2 = true;

                                    controlOk = false;

                                    for (let i = 0; i < como_llegar.length; i++) {
                                        como_llegar[i].addEventListener("click", function(evt) {
                                            var latitud = evt.target.id
                                            var longitud = evt.target.value
                                            console.log(latitud)
                                            console.log(longitud)
                                            navigator.geolocation.getCurrentPosition(
                                                function(
                                                    position) {
                                                    var currentLatLng = L.latLng(
                                                        position
                                                        .coords.latitude, position
                                                        .coords.longitude);
                                                    var targetLatLng = L.latLng(latitud,
                                                        longitud);

                                                    routingControl = L.Routing.control({
                                                        waypoints: [
                                                            currentLatLng,
                                                            targetLatLng
                                                        ]
                                                    })
                                                })
                                        })
                                    }
                                })
                            }
                        })
                    }
                }
            }
        }
    </script>