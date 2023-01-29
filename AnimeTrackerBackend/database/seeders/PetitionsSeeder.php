<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetitionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('petitions')->insert([
            'name' => 'Slam Dunk',
            'url' => 'slamdunk.com',
            'justification' => 'Porque si, porque quiero',
        ]);
    }
}
