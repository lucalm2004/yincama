<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_tipo extends Model
{
    public $timestamps = false;

    use HasFactory;
    protected $table = 'tbl_tipo';
}
