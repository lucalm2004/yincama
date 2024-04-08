<?php
use App\Models\tbl_lugar;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="./css/login.css">
    <title>Document</title>
</head>
<body>
    <div>
        <div class="row h3-exception">
            <h3>Nombre: </h3>
            <input type="text" id="nombre">
        </div>
        <div class="row h3-exception">
            <h3>Pista inicial: </h3>
            <input type="text" id="pista-inicial">
        </div>

        <div class="locations">
            <div class="row">
                <h3>1:</h3>
                <div>
                    <select class="row-exception lugar-select" id="lugar1">
                        <option></option>
                        <?php
                        $lugares = tbl_lugar::all();
                        foreach ($lugares as $lugar) {
                            echo "<option value=\"{$lugar->id_lug}\">{$lugar->nombre_lug} - {$lugar->barrio_lug} - {$lugar->desc_lug}</option>";
                        }
                        ?>
                    </select>
                    <textarea cols="25" rows="2" class="pista-textarea" placeholder="Escribe una pista para la siguiente ubicacion..." id="pista2"></textarea>
                </div>
            </div>
            <div class="row">
                <h3>2:</h3>
                <div>
                    <select class="row-exception lugar-select" id="lugar2">
                        <option></option>
                        <?php
                        foreach ($lugares as $lugar) {
                            echo "<option value=\"{$lugar->id_lug}\">{$lugar->nombre_lug} - {$lugar->barrio_lug} - {$lugar->desc_lug}</option>";
                        }
                        ?>
                    </select>
                    <textarea cols="25" rows="2" class="pista-textarea" placeholder="Escribe una pista para la siguiente ubicacion..." id="pista3"></textarea>
                </div>
            </div>
            <div class="row">
                <h3>3:</h3>
                <div>
                    <select class="row-exception lugar-select" id="lugar3">
                        <option></option>
                        <?php
                        foreach ($lugares as $lugar) {
                            echo "<option value=\"{$lugar->id_lug}\">{$lugar->nombre_lug} - {$lugar->barrio_lug} - {$lugar->desc_lug}</option>";
                        }
                        ?>
                    </select>
                    <textarea cols="25" rows="2" class="pista-textarea" placeholder="Escribe una pista para la siguiente ubicacion..." id="pista4"></textarea>
                </div>
            </div>
            <div class="row">
                <h3>4:</h3>
                <div>
                    <select class="row-exception lugar-select" id="lugar4">
                        <option></option>
                        <?php
                        foreach ($lugares as $lugar) {
                            echo "<option value=\"{$lugar->id_lug}\">{$lugar->nombre_lug} - {$lugar->barrio_lug} - {$lugar->desc_lug}</option>";
                        }
                        ?>
                    </select>
                    <textarea cols="25" rows="2" class="pista-textarea" placeholder="Escribe una pista para la siguiente ubicacion..." id="pista5"></textarea>
                </div>
            </div>
            <div class="row">
                <h3>5:</h3>
                <div class="select-row">
                    <select class="row-exception lugar-select" id="lugar5">
                        <option></option>
                        <?php
                        foreach ($lugares as $lugar) {
                            echo "<option value=\"{$lugar->id_lug}\">{$lugar->nombre_lug} - {$lugar->barrio_lug} - {$lugar->desc_lug}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <button id="submit-button">Enviar</button>
    </div>
</body>
</html>
<script src="{{ asset('js/yimcana.js') }}"></script>