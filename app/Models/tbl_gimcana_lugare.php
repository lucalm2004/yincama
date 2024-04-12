<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_gimcana_lugare extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_gim-lug';

    use HasFactory;
    protected $table = 'tbl_gimcana-lugares';
}
