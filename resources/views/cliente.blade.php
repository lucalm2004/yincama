<!DOCTYPE html>
<html>

<head>
    <title>Leaflet Map with Icons</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

   <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');

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
            /* z-index: 999; */
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
        <div id="popup-view" class="popup-content">
            <div id="yinkamas" style="display: none;">
                <script>
                    $(document).ready(function() {
                        $.ajax({
                            url: '{{ route("modal.index") }}',
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
                   </div>
    </div>

    <div id="map"></div>

    <div class='buttons-container'>
        <div id='button1' class='button'></div>
        <div id='button2' class='button'></div>
        <div id='button3' class='button'></div>
        <div id='button4' class='button'></div>
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
    document.getElementById('yinkamas').style.display = 'grid';

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
    document.getElementById('yinkamas').style.display = 'none';

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
    document.getElementById('yinkamas').style.display = 'none';

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

    </script>
    <script>

    </script>
</body>

</html>