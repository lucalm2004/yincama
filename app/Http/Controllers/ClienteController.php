<?php

namespace App\Http\Controllers;

use App\Models\tbl_lugar;
use App\Models\tbl_etiqueta; // Importar el modelo tbl_etiquetas
use App\Models\tbl_usuarios; // Importar el modelo tbl_user
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function redirecion_pagina()
    {
        return view('cliente.index');
    }

    public function listar_lugares()
    {
        $lugares = tbl_lugar::all();
        dd($lugares);
        return response()->json(['lugares' => $lugares]);
    }
    

    public function dar_favorito()
    {
        // Obtener los datos del formulario AJAX
        // $idLug = $request->id('btn_fav');
        $idUsuario = 2;
        $idLug = 2;

        // $username = session('cliente');
    
        // Verificar si ya existe un registro de etiqueta favorita
        $sql = 'SELECT * FROM tbl_etiquetas WHERE id_user_fk = ? AND id_lug_fk = ?';
        $existeEtiqueta = DB::select($sql, [$idUsuario, $idLug]);
    
        if ($existeEtiqueta) {
            // Si ya existe, eliminar el registro
            $sqlDelete = 'DELETE FROM tbl_etiquetas WHERE id_user_fk = ? AND id_lug_fk = ?';
            $deleted = DB::delete($sqlDelete, [$idUsuario, $idLug]);
            return response()->json("no");
            // return $deleted; // Retorna la cantidad de registros eliminados (0 si no se encontró)
        } else {
            // Si no existe, realizar la inserción
            $insertado = DB::table('tbl_etiquetas')->insert([
                'id_user_fk' => $idUsuario,
                'id_lug_fk' => $idLug
            ]);
            return response()->json("ok");
            // return $insertado; // Retorna true si la inserción fue exitosa
        }
    }
    public function como_llegar()
{
    // Obtener la latitud y longitud de algún lugar (supongamos que conocemos estos valores)
    $latitud = 41.34991702441951;
    $longitud = 2.1072904270792003;

    // Consulta para obtener el ID, latitud y longitud del lugar
    $sql = 'SELECT id_lug, latitud_lug, longitud_lug FROM tbl_lugares WHERE latitud_lug = ? AND longitud_lug = ?';
    $lugares = DB::select($sql, [$latitud, $longitud]);


    

    return $lugares;
}


public function mostrar_favorito()
    {
       

       

$idUsuario = 2;
$idLug = 2;

$sql = 'SELECT l.*
        FROM tbl_etiquetas e 
        INNER JOIN tbl_lugares l ON l.id_lug = e.id_lug_fk
        INNER JOIN tbl_usuario u ON u.id_user = e.id_user_fk
        WHERE e.id_user_fk = ? AND e.id_lug_fk = ?';
$favoritos = DB::select($sql, [$idUsuario, $idLug]);
return response()->json(['favoritos' => $favoritos]);
    }

}
    