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

<div id="gimcamasModal">
    <h3>Selecciona la Gincama:</h3>

    @foreach ($modal as $registro)
        <div>
            <div class="row">
                <input onclick="grupo({{ $registro->id_gim }})" id="{{ $registro->id_gim }}" type="button"
                    value="{{ $registro->nombre_gim }}" style="font-size: 16px; ">
            </div>
        </div>
    @endforeach
    <div class="submit">
        <button id="refreshGimcamas" onclick="refreshData()">¿No encuentras la Gincama?</button>
    </div>
</div>

<div id="gruposModal">
</div>



</div>

<script>
    function grupo(id) {
        var modal = document.getElementById('gimcamasModal');
        modal.style.display = 'none';

        var modale = document.getElementById('gruposModal');
        modale.style.visibility = 'visible';
        $.ajax({
            url: '/grupos?id=' + id,
            method: 'GET',
            success: function(response) {
                var html =
                    '<input type="button" id="volver" onclick="cerrar()" value="Gimcamas" class="btn btn-primary"><h3>Selecciona el grupo:</h3><div class="row">';
                        if (response.length === 0) {
                        html += '<div class="submit"><button onclick="refreshGrupo()">Crear Grupo</button></div>'
            }else{
                $.each(response, function(index, grupo) {
                html += '<input type="button" value="' + grupo.nombre_gru + '"></br>';
            
                });
            }
                     
                html += '</div>';
                html += '<div class="submit"><button onclick="refreshGrupo('+id+')">¿No encuentras a tu grupo?</button></div>'
                if (response.length > 0) {
                html += '<div class="submit"><button onclick="crearGrupo()">¿Quieres crear un grupo?</button></div>'
                }
                $('#gruposModal').html(html);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function refreshGrupo(id){
        $.ajax({
            url: '/grupos?id=' + id,
            method: 'GET',
            success: function(response) {
                var html =
                    '<input type="button" id="volver" onclick="cerrar()" value="Gimcamas" class="btn btn-primary"><h3>Selecciona el grupo:</h3><div class="row">';
                        if (response.length === 0) {
                        html += '<div class="submit"><button onclick="refreshGrupo()">Crear Grupo</button></div>'
            }else{
                $.each(response, function(index, grupo) {
                html += '<input type="button" value="' + grupo.nombre_gru + '"></br>';
            
                });
            }
                     
                html += '</div>';
                html += '<div class="submit"><button onclick="refreshGrupo('+id+')">¿No encuentras a tu grupo?</button></div>'
                if (response.length > 0) {
                html += '<div class="submit"><button onclick="crearGrupo()">¿Quieres crear un grupo?</button></div>'
                }

                $('#gruposModal').html(html);
                // $('#gruposModal').remove();

            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function cerrar() {
        var modal = document.getElementById('gimcamasModal');
        modal.style.display = 'grid';
        var modale = document.getElementById('gruposModal');
        modale.style.visibility = 'hidden';
    }




    function refreshData() {
        // Limpiar contenido existente antes de cargar los nuevos datos
        // $('#gimcamasModal').empty();

        // Hacer la solicitud AJAX para obtener los nuevos datos
        $.ajax({
            url: '/modal',
            method: 'GET',
            success: function(response) {
                // Agregar los nuevos datos al contenedor
                $('#gimcamasModal').html(response);
                $('#gruposModal').remove();

            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
</script>
