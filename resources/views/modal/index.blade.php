<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .popup-content {
            color: white;
            padding: 1rem;
            border: none;
        }

        .popup-content h3 {
            margin-bottom: 0.5rem;
        }

        .popup-content select {
            background-color: #F9F7D0 !important;
            border-radius: 5rem;
            width: 100%;
        }

        .separator {
            margin: 1rem 0;
        }

        .row {
            display: flex;
        }

        .row h3 {
            margin: 0.5rem;
        }

        .row input {
            border: none;
            width: 100%;
            margin: 0.75rem 0;
            background-color: #F9F7D0;
            height: 50%;
            border-radius: 1rem;
        }

        .row button {
            border: none;
            width: 50%;
            margin: 0.75rem 15%;
            background-color: #F9F7D0;
            height: 50%;
            border-radius: 1rem;
        }

        .submit button {
            border: none;
            width: 50%;
            margin: 0.75rem 25%;
            background-color: #F9F7D0;
            height: 50%;
            border-radius: 1rem;
        }
    </style>
</head>
<body>
    
</body>
</html>

<div>
    <h3>Tus marcadores:</h3>
    <select>
        <option></option>
        <option>Marcador1</option>
        <option>Marcador2</option>
        <option>Marcador3</option>
    </select>
</div>
<hr class="separator">
<div>
    <div class="row">
        <h3>Nombre: </h3>
        <input type="text">
    </div>
    <div class="row">
        <h3>Descripción: </h3>
        <input type="text">
    </div>
    <div class="row">
        <h3>Categoria: </h3>
        <input type="text">
    </div>
    <div class="row">
        <h3>Ubicacion: </h3>
        <button>Ver en mapa</button>
    </div>
    <div class="submit">
        <button>Actualizar / Crear</button>
    </div>
</div>