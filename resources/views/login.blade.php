<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Yimcama</title>
    <link rel="shortcut icon" href="{{ asset('img/icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <section class="sectionLogo">
        <header class="flex">
            <div class="nav">
                <img class="logoarriba" src="{{ asset('img/logo.png') }}">
            </div>
        </header>
        <br>
        <br>
        <div class="flex" id="oscuro">
            <div class="container row">
                <div class="column-2-izq flex">
                    <img class="logo" src="{{ asset('img/logo.png') }}" alt="">
                </div>
                <div class="column-2-der" id="logi">
                    <h2 id="titulo">Inicie Sesión</h2>
                        @csrf
                        <div class="inputs">
                            <label for="form2Example17">Correo:</label>
                            <input type="text" id="email" name="email" class="form-control" />
                            @if ($errors->has('email'))
                                <p id="userError" style="color: red; text-align: center;">{{ $errors->first('email') }}
                                </p>
                            @endif
                        </div>
                        <div class="inputs">
                            <label for="contrasena">Contraseña:</label>
                            <input type="password" id="password" name="password" id="form2Example27"
                                class="form-control" />
                            @if ($errors->has('password'))
                                <p id="passwordError" style="color: red; text-align: center;">
                                    {{ $errors->first('password') }}</p>
                            @endif
                            @if (session('error'))
                            <p id="passwordError" style="color: red; text-align: center;">
                                {{ session('error') }}</p>
                            @endif

                        </div>
                        <br>
                        <div class="flex">
                            <input type="hidden" id="hiddenUsername" name="hiddenUsername">
                            <input type="button" class="boton" name="inicio" value="Iniciar sesión" id="login-button">
                            {{-- <input type="button" class="boton2" name="inicio" value="registrarse" id="change"> --}}
                        </div>
                        <p style="float: right;margin-top: 5%;" id="change">¿No tienes cuenta?</p>

                </div>
                <div class="column-2-der" id="regi" style="display: none">
                    <h2 id="titulo">Registrarse</h2>
                    @csrf
                    <div class="inputs">
                        <label for="form2Example17">Nombre:</label>
                        <input type="text" id="name2" name="name" class="form-control" />
                        @if ($errors->has('name'))
                            <p id="nameError" style="color: red; text-align: center;">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="inputs">
                        <label for="form2Example17">Correo:</label>
                        <input type="text" id="email2" name="email" class="form-control" />
                        @if ($errors->has('email'))
                            <p id="userError" style="color: red; text-align: center;">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div class="inputs">
                        <label for="contrasena">Contraseña:</label>
                        <input type="password" id="password2" name="password" class="form-control" />
                        @if ($errors->has('password'))
                            <p id="passwordError" style="color: red; text-align: center;">{{ $errors->first('password') }}</p>
                        @endif
                        @if (session('error'))
                            <p id="passwordError" style="color: red; text-align: center;">{{ session('error') }}</p>
                        @endif
                    </div>
                    <br>
                    <div class="flex">
                        <input type="hidden" id="hiddenUsername" name="hiddenUsername">
                        <input type="button" class="boton" name="inicio" value="Registrarse" id="reg-button">
                        {{-- <input type="button" class="boton2" name="inicio" value="Iniciar Sesion" id="change2"> --}}
                    </div>                           
                     <p style="float: right;margin-top: 5%;" id="change2">¿Ya tienes cuenta?</p>

                </div>                
            </div>
        </div>
    </section>
    <script src="{{ asset('js/login.js') }}"></script>
</body>

</html>
