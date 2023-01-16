<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        DB::table('users')->insert(
            [
                'name' => 'Javier',
                'age'=>7,
                'email' => 'javier@correo.com',
                'password'=> 'contra123',
                'rol_id'=>1
            ]);


          
            DB::table('users')->insert(
                [
                    'name' => 'Pedro',
                    'age'=>17,
                    'email' => 'Pedro@correo.com',
                    'password'=> 'contra123',
                    'rol_id'=>2
                ]);

              
        DB::table('users')->insert(
            [
                'name' => 'Manolo',
                'age'=>70,
                'email' => 'Manolo@correo.com',
                'password'=> 'contra123',
                'rol_id'=>3
            ]);
    }
}