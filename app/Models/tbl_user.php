<?php
/* MODELO HECHO */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;
    public function rol(){
        return $this->belongsTo(tbl_roles::class);
    }
    public function grupos() {
        return $this->belongsTo(tbl_grupos::class);
    }
}
