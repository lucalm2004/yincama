<?php

namespace App\Http\Controllers;

use App\Models\tbl_lugar;
use App\Models\tbl_etiqueta; // Importar el modelo tbl_etiquetas
use App\Models\tbl_usuarios; // Importar el modelo tbl_user
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class ClienteController extends Controller
{
    public function redirecion_pagina()
    {
        return view('cliente');
    }

    public function listar_lugares()
    {
        // $lugares = tbl_lugar::all();
        $sql = 'SELECT * FROM tbl_lugares';
        $lugares = DB::select($sql);
    
        return response()->json(['lugares' => $lugares]);
    }


    public function mostrar_tipos()
    {
        // $lugares = tbl_lugar::all();
        // $sql = 'SELECT l.tipo_lug, t. FROM tbl_lugares
        // INNER JOIN tbl_lugares l ON l.tipo_lug = e.tipo';
        $sql = 'SELECT * FROM tbl_tipo';
        $mostrar_tipos = DB::select($sql);
    
        return response()->json(['mostrar_tipos' => $mostrar_tipos]);
    }




    public function listar_lugares_museos()
    {
        $sql = 'SELECT * FROM tbl_lugares WHERE tipo_lug = 1';
        $listar_lugares_museos = DB::select($sql);
    
        return response()->json(['listar_lugares_museos' => $listar_lugares_museos]);
    }

    
    public function listar_lugares_playas()
    {
        $sql = 'SELECT * FROM tbl_lugares WHERE tipo_lug = 2';
        $listar_lugares_playas = DB::select($sql);
    
        return response()->json(['listar_lugares_playas' => $listar_lugares_playas]);
    }


    public function listar_lugares_bares()
    {
        $sql = 'SELECT * FROM tbl_lugares WHERE tipo_lug = 3';
        $listar_lugares_bares = DB::select($sql);
    
        return response()->json(['listar_lugares_bares' => $listar_lugares_bares]);
    }

    public function listar_lugares_parques()
    {
        $sql = 'SELECT * FROM tbl_lugares WHERE tipo_lug = 6';
        $listar_lugares_parques = DB::select($sql);
    
        return response()->json(['listar_lugares_parques' => $listar_lugares_parques]);
    }


    public function listar_lugares_discotecas()
    {
        $sql = 'SELECT * FROM tbl_lugares WHERE tipo_lug = 4';
        $listar_lugares_discotecas = DB::select($sql);
    
        return response()->json(['listar_lugares_discotecas' => $listar_lugares_discotecas]);
    }

    public function listar_lugares_monumentos()
    {
        $sql = 'SELECT * FROM tbl_lugares WHERE tipo_lug = 5';
        $listar_lugares_monumentos = DB::select($sql);
    
        return response()->json(['listar_lugares_monumentos' => $listar_lugares_monumentos]);
    }



    public function listar_lugares_restaurante()
    {
        $sql = 'SELECT * FROM tbl_lugares WHERE tipo_lug = 7';
        $listar_lugares_restaurante = DB::select($sql);
    
        return response()->json(['listar_lugares_restaurante' => $listar_lugares_restaurante]);
    }


    
    public function listar_lugares_estacion()
    {
        $sql = 'SELECT * FROM tbl_lugares WHERE tipo_lug = 8';
        $listar_lugares_estacion = DB::select($sql);
    
        return response()->json(['listar_lugares_estacion' => $listar_lugares_estacion]);
    }




    public function listar_lugares_centros_comerciales()
    {
        $sql = 'SELECT * FROM tbl_lugares WHERE tipo_lug = 9';
        $listar_lugares_centros_comerciales = DB::select($sql);
    
        return response()->json(['listar_lugares_centros_comerciales' => $listar_lugares_centros_comerciales]);
    }

    public function listar_lugares_teatro()
    {
        $sql = 'SELECT * FROM tbl_lugares WHERE tipo_lug = 10';
        $listar_lugares_teatro = DB::select($sql);
    
        return response()->json(['listar_lugares_teatro' => $listar_lugares_teatro]);
    }

    public function dar_favorito()
    {
        // Obtener los datos del formulario AJAX
        // $idLug = $request->id('btn_fav');
        $idUsuario = Session::get('id_user');
        $idLug = $_POST['id_lugar'];

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
       

       

        $idUsuario = Session::get('id_user');

// $idLug = 1;

$sql = 'SELECT l.*
        FROM tbl_etiquetas e 
        INNER JOIN tbl_lugares l ON l.id_lug = e.id_lug_fk
        INNER JOIN tbl_usuario u ON u.id_user = e.id_user_fk
        WHERE e.id_user_fk = ?';
$favoritos = DB::select($sql, [$idUsuario]);
return response()->json(['favoritos' => $favoritos]);
    }

}
