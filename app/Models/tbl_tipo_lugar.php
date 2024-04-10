<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_tipo_lugar extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_tipo-lug';

    use HasFactory;
    protected $table = 'tbl_tipo-lugares';
}
