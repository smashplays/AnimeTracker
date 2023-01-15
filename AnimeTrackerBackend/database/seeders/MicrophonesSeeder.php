<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MicrophonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('microphones')->insert([
            'name' => 'Microphone 1',
            'description' => 'Microphone description',
            'image' => 'https://image.com/1',
            'actor_id' => 1
        ]);
    }
}
