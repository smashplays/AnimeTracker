<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnimesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('animes')->insert([
            'name' => 'Chainsaw Man',
            'description' => 'Denji Motosierra',
            'genre' => 'Action',
            'chapters' => 12,
            'status' => 'Finished',
            'start_date' => 'October 12, 2022',
            'end_date' => 'December 28, 2022',
            'image' => 'image.jpg',
            'trailer' => 'www.trailer.com',
        ]);
    }
}
