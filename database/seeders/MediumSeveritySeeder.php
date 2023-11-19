<?php

namespace Database\Seeders;

use App\Models\MediumSeverity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediumSeveritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Se invoca la factory
        MediumSeverity::factory()->count(2)->create();
    }
}
