<!DOCTYPE html>
<html>

<head>
    <title>Leaflet Map with Icons</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>

<body>
    <div class="popup-container" style="z-index: 0;">
        <div class="popup-content" id="popup-content">

        </div>
    </div>

    </div>
    </div>

    <div id="map"></div>

    <div class='buttons-container'>
        <div id='button1' class='button'></div>
        <div id='button2' class='button'></div>
        <div id='button3' class='button'></div>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
</body>

</html>
