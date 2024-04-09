<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tbl_user extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
  
        DB::table("tbl_usuario")->insert([
            [
                'nombre_user' => 'Luca',
                'correo_user' => 'luca@gmail.com',
                'pwd_user' => bcrypt('asdASD123'),
                'id_rol_fk' => 1,
            ],
            [
                'nombre_user' => 'Ian',
                'correo_user' => 'ian@gmail.com',
                'pwd_user' => bcrypt('asdASD123'),
                'id_rol_fk' => 2,
            ],
            [
                'nombre_user' => 'Mane',
                'correo_user' => 'mane@gmail.com',
                'pwd_user' => bcrypt('asdASD123'),
                'id_rol_fk' => 2,
            ],
            [
                'nombre_user' => 'Alberto',
                'correo_user' => 'alberto@gmail.com',
                'pwd_user' => bcrypt('asdASD123'),
                'id_rol_fk' => 2,
            ],
        ]);
        
    }
}