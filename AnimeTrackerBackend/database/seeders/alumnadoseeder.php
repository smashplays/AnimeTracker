<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class alumnadoseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nombre' => 'isaac',
                'telefono' => '1',
                'edad' => 24,
                'contraseña' => 'hola1',
                'email' => 'eee',
                'sexo' => 'masculino'
            ],

            [
                'nombre' => 'paca',
                'telefono' => '2',
                'edad' => 25,
                'contraseña' => 'adios2',
                'email' => 'ooo',
                'sexo' => 'femenino'
            ],

            [
                'nombre' => 'pinocha',
                'telefono' => '3',
                'edad' => 26,
                'contraseña' => 'hagtaluego',
                'email' => 'cvcvcv',
                'sexo' => 'masculino'
            ]
        ];

        DB::table('alumnos')->insert($data);
    }
}
