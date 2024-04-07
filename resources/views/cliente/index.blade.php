<!DOCTYPE html>
<html>

<head>
    <title>Leaflet Map with Icons</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="{{ asset('/resources/js/script.js') }}"></script>

    <style>
       body,
        html {
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
    opacity: 0; Inicialmente oculto
    transition: opacity 0.5s ease; /* Transición de opacidad */
}

.popup-content.visible {
    opacity: 1; /* Hacer visible */
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
            opacity: 0; /* Inicialmente oculto */
    transition: opacity 0.5s ease;
        }
        .popup-content.shifted::after {
    left: calc(36.5% - 15px);
    opacity: 1; /* Inicialmente oculto */

}

.popup-content.shifted1::after {
    left: calc(10% - 15px);
    opacity: 1; /* Inicialmente oculto */

}

.popup-content.shifted2::after {
    left: calc(63.5% - 15px);
    opacity: 1; /* Inicialmente oculto */

}


.popup-content.shifted3::after {
    left: calc(91% - 15px);
    opacity: 1; /* Inicialmente oculto */

}
    </style>
</head>

<body>
    <div class="popup-container">
        <div class="popup-content">
        </div>
    </div>

    <div id="map"></div>

    <div class='buttons-container'>
        <div id='button1' class='button'></div>
        <div id='button2' class='button'></div>
        <div id='button3' class='button'></div>
        <div id='button4' class='button'></div>
        <img src="{{asset('/img/estrella.png')}}" alt="Estrella favorita">
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
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


        var marker1 = L.marker([41.3718036, 2.1693184]).addTo(map);
    var marker2 = L.marker([41.3835454, 2.1020217]).addTo(map);
    var marker3 = L.marker([41.4199715, 2.1642218]).addTo(map);
    var marker4 = L.marker([41.4328272, 2.16272]).addTo(map);
    var marker5 = L.marker([41.4189849, 2.1437153]).addTo(map);
    
    

    // Array con todas las coordenadas guardadas
    var coordenadas = [
        [41.3718036,2.1693184,17],
        [41.3835454,2.1020217,17],
        [41.4199715,2.1642218,17],
        [41.4328272,2.16272,17],
        [41.4189849,2.1437153,17]
    ];

    marker1.on('mouseover', function (event) {
        
    // this.bindPopup("<b>Parc del Mirador de Poble-Sec </b><br>Obert ⋅ Tanca a les 22:00<br>" +
    //     "Província: Barcelona<br>Adreça: Passeig de Montjuic, s/n, 08005 Sants-Montjuic, Barcelona" +
    //     "<br><img src='./img/parc_poblesec.webp' style='width: 80%' alt='Imagen 1'>" +
    //     "<br><button class='rutaBtn'>Favorito</button>").openPopup();
        document.querySelectorAll('.rutaBtn').forEach(function(btn) {
            btn.addEventListener('click', function(event){
                var control = L.Routing.control({
                    waypoints: [
                        L.latLng(41.3498804, 2.1096487),
                        // El destino se establecerá dinámicamente al hacer clic en el mapa
                    ],
                    routeWhileDragging: true
                }).addTo(map);
                map.on('click', function (event) {
                    var destino = event.latlng;
                    control.spliceWaypoints(control.getWaypoints().length - 1, 1, destino);
                });
            });
        });
});



marker2.on('mouseover', function (event) {
    this.bindPopup("<div id='resultado'></div>").openPopup();
        document.getElementById('rutaBtn').addEventListener('click', function(event){
            // Añadir la capa de enrutamiento       
            var control = L.Routing.control({     
                waypoints: [      
                L.latLng(41.3498804, 2.1096487),        
                // El destino se establecerá dinámicamente al hacer clic en el mapa     
            ],     routeWhileDragging: true,     }).addTo(map);      
            // Agregar evento al mapa para establecer el destino al hacer clic    
             map.on('click', function (event) {       var destino = event.latlng;       
                control.spliceWaypoints(control.getWaypoints().length - 1, 1, destino);     });
        
        })
});



marker3.on('mouseover', function (event) {
    this.bindPopup("<b>Parc del Guinardó</b><br>Obert ⋅ Tanca a les 20:00<br>" +
        "Província: Barcelona<br>Adreça: Garriga i Roca, 1*13 , s/n, 08032 Horta-Guinardo, Barcelona" +
        "<br><img src='./img/parc_guinardo.webp' style='width: 80%' alt='Imagen 1'>" +
        "<br><button id='rutaBtn'>Favorito</button>").openPopup();
        document.getElementById('rutaBtn').addEventListener('click', function(event){
            // Añadir la capa de enrutamiento       
            var control = L.Routing.control({     
                waypoints: [      
                L.latLng(41.3498804, 2.1096487),        
                // El destino se establecerá dinámicamente al hacer clic en el mapa     
            ],     routeWhileDragging: true,     }).addTo(map);      
            // Agregar evento al mapa para establecer el destino al hacer clic    
             map.on('click', function (event) {       var destino = event.latlng;       
                control.spliceWaypoints(control.getWaypoints().length - 1, 1, destino);     });
        
        })
});



marker4.on('mouseover', function (event) {
    this.bindPopup("<b>Parc del Turó de la Peira</b><br>Obert les 24 hores<br>" +
        "Província: Barcelona<br>Passeig de Fabra i Puig, 396 - 406 , s/n, 08031 Nou Barris, Barcelona" +
        "<br><img src='./img/parcc_turo.webp' style='width: 80%' alt='Imagen 1'>" +
        "<br><button id='rutaBtn'>Favorito</button>").openPopup();
        document.getElementById('rutaBtn').addEventListener('click', function(event){
            // Añadir la capa de enrutamiento       
            var control = L.Routing.control({     
                waypoints: [      
                L.latLng(41.3498804, 2.1096487),        
                // El destino se establecerá dinámicamente al hacer clic en el mapa     
            ],     routeWhileDragging: true,     }).addTo(map);      
            // Agregar evento al mapa para establecer el destino al hacer clic    
             map.on('click', function (event) {       var destino = event.latlng;       
                control.spliceWaypoints(control.getWaypoints().length - 1, 1, destino);     });
        
        })
});


marker5.on('mouseover', function (event) {
    this.bindPopup("<b>Parc de la Creueta del Coll</b><br>Obert ⋅ Tanca a les 21:00<br>" +
        "Província: Barcelona<br>Passeig de la Mare de Déu del Coll 77 , s/n, 08023 Gràcia, Barcelona" +
        "<br><img src='./img/parc_creueta.webp' style='width: 80%' alt='Imagen 1'>" +
        "<br><button id='rutaBtn'>Favorito</button>").openPopup();
        document.getElementById('rutaBtn').addEventListener('click', function(event){
            // Añadir la capa de enrutamiento       
            var control = L.Routing.control({     
                waypoints: [      
                L.latLng(41.3498804, 2.1096487),        
                // El destino se establecerá dinámicamente al hacer clic en el mapa     
            ],     routeWhileDragging: true,     }).addTo(map);      
            // Agregar evento al mapa para establecer el destino al hacer clic    
             map.on('click', function (event) {       var destino = event.latlng;       
                control.spliceWaypoints(control.getWaypoints().length - 1, 1, destino);     });
        
        })
});



        L.control.zoom({
            position: 'bottomright'
        }).addTo(map);

    </script>
    <script>

    </script>
</body>

</html>