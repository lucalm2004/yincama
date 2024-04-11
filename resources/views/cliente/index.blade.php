<!DOCTYPE html>
<html>

<head>
    <title>Leaflet Map with Icons</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" crossorigin="" />

    <!-- Esri Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@3.1.3/dist/esri-leaflet-geocoder.css"
        crossorigin="" />
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
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .leaflet-top {
            margin-top: 30% !important
        }

        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .leaflet-popup-close-button {
            background-color: black !important;
            color: white !important;
            /* padding: 1.5% 4%!important; */
            margin: 1%;
            border-radius: 100% !important;
            text-decoration: none !important;
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
            position: absolute;
            height: 12%;
            width: 100%;
            z-index: 999;
            display: flex;
            justify-content: center;
            align-items: center;
            bottom: 88%;
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
            z-index: 999;
            width: 100%;
            height: 88%;
            top: 12%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background-color: #293A68;
            height: 80vh;
            width: 90vw;
            position: relative;
            border-radius: 1rem;
            margin: 19px;
            opacity: 0;
            Inicialmente oculto transition: opacity 0.5s ease;
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

        .leaflet-right {
            padding-left: 50%
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

        .popup-content.shifted2::after {
            left: calc(63.5% - 15px);
            opacity: 1;
            /* Inicialmente oculto */

        }


        .popup-content.shifted3::after {
            left: calc(91% - 15px);
            opacity: 1;
            /* Inicialmente oculto */

        }
    </style>
</head>

<body>
    <div id="popup-container" class="popup-container">
        <div class="popup-content" id="ventana_azul">
            <div id="Favoritos" style="display: block;"></div>
        </div>
    </div>

    <div id="map"></div>

    <div class='buttons-container'>
        <div id='button1' class='button'></div>
        <div id='button2' class='button'></div>
        <div id='button3' class='button'></div>
        <div id='button4' class='button'></div>
    </div>



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
            document.getElementById('Favoritos').style.display = 'none'

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
        button2.onclick = function() {
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
            document.getElementById('Favoritos').style.display = 'block'
            mostrarFavoritos();

            if (popupContent.classList.contains('shifted2')) {
                removeClasses();
                // console.log("Lpd")
                /* HACER AJAX QUE DEVUELVA LA CONSULTA */






                container.style = 'z-index: 0;'

                popupContent.classList.remove('visible'); // Ocultar suavemente
            } else {
                removeClasses();
                container.style = 'z-index: 999;'

                popupContent.classList.add('visible'); // Mostrar suavemente
                popupContent.classList.toggle('shifted2');
            }
        };

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
                    

                    // FALTA HACER QUE SE MUESTRE UNA RUTA SOLAMENTE Y LAS OTRAS SE BORRAN
                });
            }
        }



        function mostrarFavoritos() {
            var ajax = new XMLHttpRequest();
            var formdata = new FormData();

            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formdata.append('_token', csrfToken);

            ajax.open('POST', '/mostrar_favorito');

            ajax.onload = function() {
                if (ajax.status == 200) {

                    var json = JSON.parse(ajax.responseText);
                    var favoritos = json.favoritos;

                    var contenidoHtml = ''; // Variable para almacenar el contenido HTML

                    favoritos.forEach(function(item) {
                        contenidoHtml += "<h3>" + item.nombre_lug + "</h3>";
                        contenidoHtml += "<p>" + item.barrio_lug + "</p>";
                        contenidoHtml += "<p>" + item.desc_lug + "</p>";
                        if(controlOk2 === false){
                            contenidoHtml +=
                            "<button type='button''class='btn_llegar' id='btn_fav' onclick='darFavorito()'" +
                            item.id_lug +
                            "' value='" + item.tipo_lug +
                            "'> Favorito </button>";

                        }else{
                            contenidoHtml +=
                            "<button type='button''class='btn_llegar' id='btn_fav' onclick='darFavorito()'" +
                            item.id_lug +
                            "' value='" + item.tipo_lug +
                            "'> Favorito </button><button onclick='mostrarEvent(event)' type='button' name='btn_llegae' id='" +
                            item.latitud_lug + "' value='" + item.longitud_lug +
                            "' class='btn'>Como Llegar</button>";

                        }
                       

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

        var button4 = document.getElementById('button4');
        button4.onclick = function() {
            document.getElementById('Favoritos').style.display = 'none'

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


        // Crear un marcador arrastrable y añadirlo al mapa
        // var marker = L.marker([41.3718036, 2.1693184], { draggable: true }).addTo(map);

        // // Agregar un evento para mostrar las coordenadas al arrastrar el marcador
        // marker.on('dragend', function(event) {
        //     var marker = event.target;
        //     var position = marker.getLatLng();
        //     alert('Marcador arrastrado a la ubicación: ' + position.lat + ', ' + position.lng);
        // });


        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);



        ListarLugares();
        var lc = L.control.locate({
            drawCircle: true,
            circleStyle: {
                radius: 200

            }
        }).addTo(map);

        const apiKey =
            "AAPK81ad74d3dfd8436fb340536133638fa63ALxp-zis1f4_UJQXProlf6PHzR0q-zOvEnfcnjIbYi2VLIrKWd86ViJHzwjoKVJ";

        const apiKey2 =
            "https://nominatim.openstreetmap.org/search?q=1600+Amphitheatre+Parkway,+Mountain+View,+CA&format=json";

        lc.start();
        // darFavorito();
        // Define el ícono que se utilizará para los marcadores
        var icono = L.icon({
            iconUrl: 'ruta/a/tu/icono.png',
            iconSize: [30, 30], // Tamaño del ícono
            iconAnchor: [15, 30], // Punto de anclaje del ícono
            popupAnchor: [0, -30] // Punto donde se abrirá el popup en relación al ícono
        });

        function ListarLugares() {
            var ajax = new XMLHttpRequest();
            var formdata = new FormData();

            // Agrega el token CSRF al FormData
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formdata.append('_token', csrfToken);

            ajax.open('POST', '/cliente');

            ajax.onload = function() {
                if (ajax.status === 200) {
                    var json = JSON.parse(ajax.responseText);
                    var lugares = json.lugares;

                    if (lugares && lugares.length > 0) {
                        lugares.forEach(function(lugar) {
                            var latitud = parseFloat(lugar.latitud_lug);
                            var longitud = parseFloat(lugar.longitud_lug);
                            if (!isNaN(latitud) && !isNaN(longitud)) {
                                var marker = L.marker([latitud, longitud], {
                                    icon: icono
                                }).addTo(map);
                                marker.bindPopup("<div><h2 style='margin-bottom: -20px'>" + lugar.barrio_lug +
                                        "</h2> <p style='color: grey'>" + lugar.nombre_lug +
                                        "</p> <hr> <p>" + lugar.desc_lug +
                                        "</p><button type='button''class='btn_llegar' id='btn_fav' onclick='darFavorito()'" +
                                        lugar.id_lug +
                                        "' value='" + lugar.tipo_lug +
                                        "'> Favorito </button><button type='button' name='btn_llegar' id='" +
                                        lugar.latitud_lug + "' value='" + lugar.longitud_lug +
                                        "' class='btn'  >Como Llegar</button></div>"
                                    )
                                    .openPopup();

                                // var routingControl
                                marker.on("click", function() {
                                    // console.log("Marker clicked:", lugar.nombre_lug, lugar.barrio_lug,
                                    //     lugar.desc_lug);
                                    var como_llegar = document.getElementsByName("btn_llegar");
                                    console.log(controlOk)
                                    console.log(controlOk2)

                                    if (controlOk === true || controlOk2 === true) {
                        routingControl.spliceWaypoints(0, 1); // Elimina el marcador de inicio (índice 0)
                        routingControl.spliceWaypoints(routingControl.getWaypoints().length - 1,
                        1); // Elimina el marcador de destino (último índice)

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
                                            navigator.geolocation.getCurrentPosition(function(
                                                position) {
                                                var currentLatLng = L.latLng(position
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
                                                            // Aquí puedes agregar el código para cerrar el modal según cómo esté implementado en tu página
                                                            // Por ejemplo, si estás usando Bootstrap, puedes cerrar el modal así:
                                                            // $('#myModal').modal('hide');
                                                        }
                                                    });
                                            });

                                        })
                                    }

                                });
                            } else {
                                console.log("Error: Coordenadas inválidas para el lugar:", lugar.nombre_lug);
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
        //         setInterval(function() {

        //     // Llamar a la función para listar usuarios con el valor actual
        //     ListarLugares();
        //     // CrudPelis(valor_peli);
        // }, 1000); 





        function darFavorito(csrfToken) {
            var ajax = new XMLHttpRequest();
            var formdata = new FormData();

            // Agrega el token CSRF al FormData
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formdata.append('_token', csrfToken);

            ajax.open('POST', '/añadir_like');

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

        // function comoLlegar() {
        //     var lc = L.control.locate({
        //     drawCircle: true,
        //     circleStyle: {
        //         radius: 200

        //     }
        // }).addTo(map);
        // }

        // function comoLlegar(latitud, longitud) {
        //     var ajax = new XMLHttpRequest();
        //     var formdata = new FormData();

        //     // Agrega el token CSRF al FormData
        //     var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        //     formdata.append('_token', csrfToken);

        //     ajax.open('POST', '/añadir_camino');

        //     // Añadir la capa de enrutamiento
        //     var control = L.Routing.control({
        //         waypoints: [
        //             L.latLng(latitud, longitud), // Punto de partida
        //             // El destino se establecerá dinámicamente al hacer clic en el mapa
        //         ],
        //         routeWhileDragging: true,
        //     }).addTo(map);

        //     // Agregar el lugar específico a la función comoLlegar
        //     comoLlegar(latitud, longitud);
    </script>
    <script></script>
</body>

</html>
