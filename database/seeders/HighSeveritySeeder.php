<?php

namespace Database\Seeders;

use App\Models\HighSeverity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HighSeveritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Se llama a la factory
        HighSeverity::factory()->count(2)->create();
    }
}
