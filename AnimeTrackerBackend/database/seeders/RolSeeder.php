<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        DB::table('rols')->insert(
            [
                'name' => 'Admin',
                'descripcion'=>"descripcion de admin",
            ]);


            DB::table('rols')->insert(
                [
                    'name' => 'Usuario',
                    'descripcion'=>"descripcion de usuario",
                ]);

            DB::table('rols')->insert(
                [
                    'name' => 'Currito',
                    'descripcion'=>"descripcion de currito",
                ]);
    }
}
