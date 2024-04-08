<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div id="log">
        <form class="form" >
            <label for="" class="">Usuario</label>
            <br>
            <input type="text" id="user" maxlength="50">
            <br>
            <br>
            <label for="" class="">Contraseña</label>
            <br>
            <input type="password" id="contra" maxlength="12">
            <br>
            <br>
            <button type="button" id="login-button" class="button1">Enviar</button>
        </form>
    </div>
</body>
</html>
<script src="{{ asset('js/login.js') }}"></script>