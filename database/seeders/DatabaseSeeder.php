<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this -> call(tbl_roles::class);
        $this -> call(tbl_tipo::class);
        $this -> call(tbl_lugares::class);
        $this -> call(tbl_gimcana::class);
        $this -> call(tbl_grupos::class);
        $this -> call(tbl_user::class);
        $this -> call(tbl_gimcana_lugares::class);
        $this -> call(tbl_tipo_lugares::class);
        $this -> call(tbl_etiquetas::class);
        $this -> call(tbl_grupos_user::class);
        $this -> call(tbl_check::class);

        
    }
}
