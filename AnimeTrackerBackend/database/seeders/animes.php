<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class animes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

            'nombre' => 'isaac',
            'descripcion' => '1',
            'generos' => 'sdsd',
            'capitulo' => 'hola1',
            'estado' => 'eee',
            'fecha_inicio' => 'masculino',
            'fecha_fin' => 'masculino',
            'URL_imagen' => 'masculino',

        ];

        DB::table('animes')->insert($data);
    }
}
