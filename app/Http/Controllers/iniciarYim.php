<?php

namespace App\Http\Controllers;

use App\Models\tbl_grupo;
use Illuminate\Http\Request;

class iniciarYim extends Controller
{
    public function iniciarYim(Request $request)
    {
        // Validación de datos
        $request->validate([
            'id' => 'required|integer|exists:tbl_grupos,id_gru',
            'gru' => 'nullable|integer|exists:tbl_gim_lugs,id_gim_lug', // Corregir el nombre de la columna
        ]);
        echo "hey";
        // Actualizar grupo
        $grupo = tbl_grupo::findOrFail($request->id);
        // Asumiendo que el campo correcto es 'id_gim_lug_fk'
        $grupo->id_gim_lug_fk = $request->gru; // Corregir el nombre del campo
        $grupo->save();

        return response()->json(['mensaje' => 'Grupo actualizado exitosamente'], 200);
    }
}
