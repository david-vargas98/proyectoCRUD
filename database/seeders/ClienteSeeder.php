<?php

namespace Database\Seeders;

use App\Models\Cliente; //Se debe de importar el modelo
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Sutiliza la factory para insertar datos en la base de datos
        Cliente::factory()->count(10)->create();
    }
}
