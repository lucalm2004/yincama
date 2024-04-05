<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class tbl_grupos_user extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table("tbl_grupos_user")->insert([
            [
                'id_grupo' => '1',
                'id_user' => '1',
                
            ],
            [
                'id_grupo' => '2',
                'id_user' => '2',
                
            ],
            [
                'id_grupo' => '3',
                'id_user' => '3',
                
            ],
            [
                'id_grupo' => '4',
                'id_user' => '4',
                
            ],
        ]);
    }
}
