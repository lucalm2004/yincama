<?php
if (!session('id_user')){
        header("Location: /");
        exit();
    }
?>

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

        .swal2-confirm {
            background-color: #F9F7D0 !important;
            color: black !important;

        }

        .swal2-html-container{
            margin: 0%!important;
        }
        .separator {
            margin: 1rem 0;
        }

        .row {
            /* display: flex;
            gap: 5px; */
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
            padding-top: 3%;
            padding-bottom: 3%;
            padding-left: 3%;


        }

        #volver {
            border: none;
            /* width: 100%; */
            margin: 0.75rem 0;
            background-color: #F9F7D0;
            /* height: 50%; */
            border-radius: 1rem;
            padding-top: 3%;
            padding-bottom: 3%;
            padding-left: 3%;

        }
        .btn_llegar{

border: none;
width: 50%;
margin: 0.75rem 25%;
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

        .buttone {
            border: none;
            width: 50%;
            background-color: #F9F7D0;
            height: 50%;
            border-radius: 1rem;
            margin-left: 8%;
        }

        .submit button {
            border: none;
            width: 70%;
            margin: 0.75rem 15%;
            background-color: #F9F7D0;
            height: 50%;
            border-radius: 1rem;
            padding-top: 3%;
            padding-bottom: 3%;
            padding-left: 3%;
        }

       

        #yinkamas {
            max-height: 100%;
            overflow-y: scroll;
            margin-bottom: 0px;
        }
    </style>
</head>

<body>

</body>

</html>

<div id="perfil">
    <div style="display: flex; align-items: center;">
        {{-- {{dd($modal)}} --}}
        <h4>Bienvenido, {{ $modal->first()->nombre_user }}</h4>
        <button class="buttone" id="chgpwd"><b>Cambiar contraseña</b></button>
    </div>
    <div>
        <div class="row">
            <input style="text-align: left;font-size: 16px;" type="button"
                value="Nombre: {{ $modal->first()->nombre_user }}">
            <input style="text-align: left;font-size: 16px;" type="button"
                value="Correo: {{ $modal->first()->correo_user }}">
            @if ($modal->first()->id_rol_fk == 2)
                <input style="text-align: left;font-size: 16px;" type="button" value="Eres un: Alumno/Cliente">
            @else
                <input style="text-align: left;font-size: 16px;" type="button" value="Eres un: Profesor/Administrador">
            @endif
            <input style="text-align: left;font-size: 16px;" type="button"
                value="Total Gincanas: {{ $modal->count() }}">
        </div>
    </div>

    <div class="submit">
        <button id="chgDatos"><b>Cambiar mis datos</b></button>
    </div>
</div>

<script>
    document.getElementById("chgpwd").addEventListener("click", function() {
        Swal.fire({
            title: 'Pon una contraseña',
            input: 'text',
            inputPlaceholder: 'Contraseña...',
            showCancelButton: true,
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar',
            allowOutsideClick: false,
            inputValidator: (value) => {
                if (!value) {
                    return '¡Debes ingresar una contraseña!';
                }
                if (!/[A-Z]/.test(value) || !/\d/.test(value)) {
                    return 'La contraseña debe contener al menos una letra mayúscula y un número.';
                }
            }
        }).then((result) => {
            // Si el usuario hace clic en "Confirmar" y proporciona un valor
            if (result.isConfirmed) {
                // Obtener el valor del input
                const contraseña = result.value;
$.ajax({
    url: '/cambiarpwd',
    method: 'POST',
    data: {
        contraseña: contraseña
    },
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {
        Swal.fire({
                            icon: 'success',
                            title: 'Constraseña cambiada',
                        });    },
    error: function(xhr, status, error) {
        console.error(error);
    }
});


            }
        });
    });

    document.getElementById("chgDatos").addEventListener("click", function() {
        Swal.fire({
    title: 'Cambiar datos',
    html:
        '<input id="nombre" value="{{ $modal->first()->nombre_user }}" class="swal2-input" placeholder="Nombre" type="text">' +
        '<input id="correo" value="{{ $modal->first()->correo_user }}" class="swal2-input" placeholder="Correo electrónico" type="email">',
    showCancelButton: true,
    confirmButtonText: 'Confirmar',
    cancelButtonText: 'Cancelar',
    allowOutsideClick: false,
    preConfirm: () => {
        const nombre = document.getElementById('nombre').value;
        const correo = document.getElementById('correo').value;
        if (!nombre || !correo) {
            Swal.showValidationMessage('Por favor, complete todos los campos.');
        } else if (!/^[a-zA-Z ]+$/.test(nombre)) {
            Swal.showValidationMessage('El nombre solo puede contener letras y espacios.');
        } else if (!/\S+@\S+\.\S+/.test(correo)) {
            Swal.showValidationMessage('Por favor, ingrese un correo electrónico válido.');
        } else {
            // Aquí puedes hacer lo que quieras con los valores de nombre y correo
            return { nombre: nombre, correo: correo };
        }
    }
        }).then((result) => {
            // Si el usuario hace clic en "Confirmar" y proporciona un valor
            if (result.isConfirmed) {
                // Obtener el valor del input
                const nombre = result.value.nombre;
                const correo = result.value.correo;
        $.ajax({
    url: '/cambiarUser',
    method: 'POST',
    data: {
        nombre: nombre,
        correo: correo

    },
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {
        Swal.fire({
                            icon: 'success',
                            title: 'Usuario actualizado',
                        }); 
                        cargarPerfil();
   },
    error: function(xhr, status, error) {
        console.error(error);
    }
});


            }
        });
    });
</script>
