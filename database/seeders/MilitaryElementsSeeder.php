<?php

namespace Database\Seeders;

use App\Models\MilitaryElements;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MilitaryElementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Se llama a la factory
        MilitaryElements::factory()->count(140)->create();
    }
}
