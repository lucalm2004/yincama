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
        <button id="refreshGimcamas" onclick="refreshData()">Â¿No encuentras la Gincama?</button>
    </div>
</div>

<div id="gruposModal">
</div>


<div id="grupoModal">
</div>



</div>

<script>
    function grupo(id) {

        var modal = document.getElementById('gimcamasModal');
        modal.style.display = 'none';

        var modale = document.getElementById('gruposModal');
        // modale.style.visibility = 'visible';
        modale.style.display = 'block';

        $.ajax({
            url: 'grupos?id=' + id,
            method: 'GET',
            success: function(response) {
                var html =
                    '<input type="button" id="volver" onclick="cerrar()" value="Gimcamas" class="btn btn-primary"><h3>Selecciona el grupo:</h3><div class="row">';
                if (response.length === 0) {
                    html +=
                        '<div class="submit"><button onclick="crearGrupo(' + id +
                        ')">Crear Grupo</button></div>'
                } else {
                    $.each(response, function(index, grupo) {
                        html += '<input onclick="unirse(' + grupo.id_gru + ',' + id +
                            ')" type="button" value="' + grupo.nombre_gru + '"></br>';

                    });
                }

                html += '</div>';
                html += '<div class="submit"><button onclick="refreshGrupo(' + id +
                    ')">Â¿No encuentras a tu grupo?</button></div>'
                if (response.length > 0) {
                    html +=
                        '<div class="submit"><button onclick="crearGrupo(' + id +
                        ')">Â¿Quieres crear un grupo?</button></div>'
                }
                $('#gruposModal').html(html);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function refreshGrupo(id) {
        console.log(id)
        var ide = id;
        $.ajax({
            url: 'grupos?id=' + id,
            method: 'GET',
            success: function(response) {
                var html =
                    '<input type="button" id="volver" onclick="cerrar()" value="Gimcamas" class="btn btn-primary"><h3>Selecciona el grupo:</h3><div class="row">';
                if (response.length === 0) {

                    html += '<div class="submit"><button onclick="crearGrupo(' + ide +
                        ')">Crear Grupo</button></div>'
                } else {
                    $.each(response, function(index, grupo) {
                        html += '<input type="button" onclick="unirse(' + grupo.id_gru + ',' + id +
                            ')" value="' + grupo.nombre_gru + '"></br>';

                    });
                }

                html += '</div>';
                html += '<div class="submit"><button onclick="refreshGrupo(' + ide +
                    ')">Â¿No encuentras a tu grupo?</button></div>'
                if (response.length > 0) {
                    html += '<div class="submit"><button onclick="crearGrupo(' + ide +
                        ')">Â¿Quieres crear un grupo?</button></div>'
                }

                $('#gruposModal').html(html);
                // $('#gruposModal').remove();

            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function unirse(id, idgru) {
        var modale = document.getElementById('gruposModal');
        // modale.style.visibility = 'hidden';
        modale.style.display = 'none';

        var modal = document.getElementById('grupoModal');
        modal.style.display = 'block';

        $.ajax({
            url: 'unirseGrupo?id=' + id,
            method: 'GET',
            success: function(response) {
                refreshGrupo(id);
                var html =
                    '<input type="button" id="volver" onclick="cerrarG(' + idgru +
                    ')" value="Grupos" class="btn btn-primary"><h3>Grupo: </h3><div class="row">';

                var count = response.length;

                html += '<p>Total: ' + count + '/4 personas.</p>';

                $.each(response, function(index, grupo) {
                    html += '<input type="button"  value="' + grupo.nombre_user + '"></br>';
                });

                html += '</div>';

                if (response.length > 4) {
                    html +=
                        '<div  class="submit"><button style="background-color: #989898;!important" id="unirseBtn">Grupo lleno.</button></div>';
                    $(document).on('click', '#unirseBtn', function() {

                        Swal.fire({
                            icon: 'error',
                            title: 'Grupo lleno',
                            text: 'El grupo estÃ¡ lleno. Por favor, cree uno nuevo.'
                        });

                    });
                    html += '<div class="submit"><button onclick="iniciarGimcama(' + id +
                        ', ' + idgru + ')">Â¡Iniciar Gimcama!</button></div>';
                    
                } else {
                    html += '<div class="submit"><button onclick="iniciarGimcamaSin(' + id +
                        ', ' + idgru + ')">Â¡Iniciar Gimcama!</button></div>';
                    
                    html += '<div class="submit"><button onclick="unirseGrupo(' + id +
                        ', ' + idgru + ')">Unirse al grupo.</button></div>';
                }



                $('#grupoModal').html(html);

            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

   function iniciarGimcamaSin(id,gru){
        Swal.fire({
            title: 'Â¿Estas seguro que quieres iniciar la gimcama sin todos los miembros?',
            showCancelButton: true,
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar',
            allowOutsideClick: false,
        }).then((result) => {
            iniciarGimcama(id,gru);
        });
    }


function iniciarGimcama(gru,id){
    var gru;
    var id;
    console.log(gru,id);
    var csrfToken = document.querySelector("meta[name='csrf-token']").getAttribute('content');
    var formData = new FormData();

    formData.append('gru', gru);
    formData.append('gim', id);
    formData.append('_token', csrfToken);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'iniciarYim');
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    console.log('ejecutando');
    xhr.send(formData);
    xhr.onload = function() {
        if (xhr.status == 200) {
            Swal.fire({
                text: xhr.responseText,
            });
            removeClasses();
        container.style = 'z-index: 0;'
            dameUbi(csrfToken);
        } else {
            console.error('Error en la solicitud:', xhr.responseText);
        }
    };  
    xhr.onerror = function() {
        console.error('Error en la solicitud AJAX:', xhr.statusText);
    };    
}

    function unirseGrupo(id, idgru) {
        // $session recuperar la variable del usuario para enviarlo
        // $userid = $_SESSION['id_user'];
        $.ajax({
            url: 'agregaGrupo?id=' + id,
            // url: '/agregaGrupo?id=' + id +'&idUser='+$userid,

            method: 'GET',
            success: function(response) {

                unirse(id, idgru)

            },
            error: function(xhr, status, error) {

                Swal.fire({
                    icon: 'error',
                    title: 'Ya estás en el grupo.',
                    text: 'Dale clic a OK para salirte del grupo.',
                    showCancelButton: true, // Mostrar botón de Cancelar
                    cancelButtonText: 'Cancelar' // Texto para el botón de Cancelar
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'eliminarGrupo?id=' + id,
                            method: 'GET',

                            success: function(response) {

                                                unirse(id, idgru)

                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    }
                });
            }

        });


    }

function dameUbi(csrfToken) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ubicacion');
    
    // AsegÃºrate de tener el token CSRF definido adecuadamente
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    
    // Manejo de la respuesta de la solicitud
    xhr.onload = function() {
        if (xhr.status == 200) {
            xhr.responseText
            var texto = xhr.responseText;
            var partes = texto.split(',');
            var latitudObjetivo = partes[0];
            var longitudObjetivo = partes[1];
                setInterval(function() {
                    compararCoordenadas(latitudObjetivo, longitudObjetivo);
                }, 3000); 
        } else {
            console.error('Error en la solicitud:', xhr.status);
        }
    };
    
    // Manejo de errores de red u otros
    xhr.onerror = function() {
        console.error('Error de red al realizar la solicitud');
    };

    console.log('Ejecutando solicitud...');
    
    xhr.send();
}


    function cerrarG(id) {
        var modal = document.getElementById('gruposModal');
        // modal.style.visibility = 'visible';
        modal.style.display = 'block';


        var modale = document.getElementById('grupoModal');
        // modale.style.visibility = 'hidden';
        modale.style.display = 'none';
        grupo(id)


    }

    function crearGrupo(id) {
    // Mostrar SweetAlert con un input para el nombre del grupo
    Swal.fire({
        title: 'Crear un grupo',
        input: 'text',
        inputPlaceholder: 'Ingrese el nombre del grupo',
        showCancelButton: true,
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false,
        inputValidator: (value) => {
            if (!value) {
                return 'Debes ingresar un nombre para el grupo';
            }
        }
    }).then((result) => {
        // Si el usuario hace clic en "Confirmar" y proporciona un valor
        if (result.isConfirmed) {
            // Obtener el valor del input
            const nombreGrupo = result.value;
            $.ajax({
                url: 'creargrupo?id=' + id + '&nombre=' + nombreGrupo,
                method: 'GET',
                success: function(response) {
                    refreshGrupo(id);
                },
                error: function(xhr, status, error) {
                    // Mostrar SweetAlert con el mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'El grupo ya existe'
                    });
                    console.error(error);
                }
            });
        }
    });
}



    function cerrar() {
        var modal = document.getElementById('gimcamasModal');
        modal.style.display = 'grid';
        var modale = document.getElementById('gruposModal');
        // modale.style.visibility = 'hidden';
        modale.style.display = 'none';

    }




    function refreshData() {
        // Limpiar contenido existente antes de cargar los nuevos datos
        // $('#gimcamasModal').empty();

        // Hacer la solicitud AJAX para obtener los nuevos datos
        $.ajax({
            url: 'modal',
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

function compararCoordenadas(latitudObjetivo, longitudObjetivo) {
    console.log(latitudObjetivo, longitudObjetivo);
    if (latitudObjetivo != '' && longitudObjetivo != '') {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitudActual = position.coords.latitude;
                var longitudActual = position.coords.longitude;
                console.log(latitudActual, longitudActual);
                
                var radioTierra = 6371000; // Radio de la Tierra en metros
                var latitudRadObjetivo = latitudObjetivo * Math.PI / 180; // Convertir latitudes a radianes
                var latitudRadActual = latitudActual * Math.PI / 180;
                var cambioLatitudRad = (latitudObjetivo - latitudActual) * Math.PI / 180;
                var cambioLongitudRad = (longitudObjetivo - longitudActual) * Math.PI / 180;

                var a = Math.sin(cambioLatitudRad/2) * Math.sin(cambioLatitudRad/2) +
                        Math.cos(latitudRadActual) * Math.cos(latitudRadObjetivo) *
                        Math.sin(cambioLongitudRad/2) * Math.sin(cambioLongitudRad/2);
                var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));

                var distancia = radioTierra * c; // Distancia en metros
                if (distancia <= 5000 && latitudObjetivo != 0) {
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            Swal.fire({
                                text: xhttp.responseText,
                            });
                            dameUbi(csrfToken);
                        }
                    };
                    xhttp.open("GET", "/nuevaP", true); // Reemplaza '/ruta' con la ruta real en tu aplicación Laravel
                    xhttp.send();
                }
                else {
                    console.log('Estás fuera del área.');
                }
            });
        } else {
            console.log("Geolocalización no es soportada por este navegador.");
        }
    } else {
        console.log("Las coordenadas objetivo no están definidas.");
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
