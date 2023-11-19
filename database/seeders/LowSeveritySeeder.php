<?php

namespace Database\Seeders;

use App\Models\LowSeverity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LowSeveritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Se invoca la factory
        LowSeverity::factory()->count(2)->create();
    }
}
