<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharactersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('characters')->insert([
            'name' => 'Rintarou Okabe',
            'description' => 'Rintarou Okabe is the main protagonist of Steins;Gate series.',
            'age' => 18,
            'image' => 'https://image.com/1',
            'actor_id' => 1
        ]);
    }
}
