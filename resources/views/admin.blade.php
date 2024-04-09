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

    <div id="gincanas" class="temp">
        <div>
            <div>
                <h3>Tus Gincanas:</h3>
                <div class="row">
                    <select>
                        <option></option>
                        <option>Gincana1</option>
                        <option>Gincana2</option>
                        <option>Gincana3</option>
                    </select>
                </div>
            </div>
            <hr>
            <div>
                <div class="row h3-exception">
                    <h3>Nombre: </h3>
                    <input type="text">
                </div>
                <div class="row h3-exception">
                    <h3>Pista: </h3>
                    <input type="text">
                </div>

                <div class="locations">
                    <div class="row">
                        <h3>1:</h3>
                        <div class="row-before">
                            <select class="row-exception">
                                <option></option>
                                <option>Marcador1</option>
                                <option>Marcador2</option>
                                <option>Marcador3</option>
                            </select>
                            <textarea cols="25" rows="2" placeholder="Escribe una pista para la siguiente ubicacion..."></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <h3>2:</h3>
                        <div class="row-before">
                            <select class="row-exception">
                                <option></option>
                                <option>Marcador1</option>
                                <option>Marcador2</option>
                                <option>Marcador3</option>
                            </select>
                            <textarea cols="25" rows="2" placeholder="Escribe una pista para la siguiente ubicacion..."></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <h3>3:</h3>
                        <div class="row-before">
                            <select class="row-exception">
                                <option></option>
                                <option>Marcador1</option>
                                <option>Marcador2</option>
                                <option>Marcador3</option>
                            </select>
                            <textarea cols="25" rows="2" placeholder="Escribe una pista para la siguiente ubicacion..."></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <h3>4:</h3>
                        <div class="row-before">
                            <select class="row-exception">
                                <option></option>
                                <option>Marcador1</option>
                                <option>Marcador2</option>
                                <option>Marcador3</option>
                            </select>
                            <textarea cols="25" rows="2" placeholder="Escribe una pista para la siguiente ubicacion..."></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <h3>5:</h3>
                        <div class="row-before">
                            <select class="row-exception">
                                <option></option>
                                <option>Marcador1</option>
                                <option>Marcador2</option>
                                <option>Marcador3</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="submit">
                    <button>Actualizar / Crear</button>
                    <button>Eliminar</button>
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
