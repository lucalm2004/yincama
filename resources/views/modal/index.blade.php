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

<div id="gruposModal">asd
</div>



</div>

<script>
    function grupo(id) {
    var modal = document.getElementById('gimcamasModal');
    modal.style.display = 'none';

    $.ajax({
        url: '/grupos?id=' + id,
        method: 'GET',
        success: function(response) {
            var html = '<h3>Selecciona el grupo:</h3><div class="row">';
            $.each(response, function(index, grupo) {
                html += '<input type="button" value="' + grupo.nombre_gru + '">';
            });
            html += '</div>';
            $('#gruposModal').html(html);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}



    

    function refreshData() {
        $.ajax({
            url: '/modal',
            method: 'GET',
            success: function(response) {
                $('#gruposModal').html(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
</script>
