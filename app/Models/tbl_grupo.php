<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_grupo extends Model
{
    use HasFactory;
    protected $table = 'tbl_grupos';
    protected $primaryKey = 'id_gru';
}
