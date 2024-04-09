<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tbl_check extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table("tbl_check")->insert([
            [
                'id_gim-lug_fk' => '1',
                'id_user_fk' => '1',
                
               
            ],
            [
                'id_gim-lug_fk' => '1',
                'id_user_fk' => '2',
                
             
               
            ],
            [
                'id_gim-lug_fk' => '1',
                'id_user_fk' => '3',
               
               
            ],
            [
                'id_gim-lug_fk' => '1',
                'id_user_fk' => '4',
                
              
            ],
        ]);
    }
}