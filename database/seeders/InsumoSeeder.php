<?php

namespace Database\Seeders;

use App\Models\Insumo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InsumoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Se define la clase y su factory, así como se le indica cuantos registros crear
        Insumo::factory()->count(10)->create();
    }
}
