<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('actors')->insert([
            'name' => 'Mamoru Miyano',
            'description' => 'A Japanese actor, voice actor, singer and narrator from Saitama Prefecture.            ',
            'age' => 39,
            'image' => 'https://image.com/1',
        ]);
    }
}
