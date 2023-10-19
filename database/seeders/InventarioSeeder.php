<?php

namespace Database\Seeders;

use App\Models\Inventario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Esta es una insersión manual, que asegura que siempre haya al menos un registro con esos valores específicos en la tabla. Esto puede ser importante si la lógica en la aplicación depende de la presencia de ese registro. Es opcional.
        DB::table("inventarios")->insert([
            'descripcion' => 'Colorante Azul',
        ]);
        //Se utiliza la factory InventarioFactory para crear 3 registros adicionales con valores aleatorios. Estos registros ficticios se generan usando el método definition() del factory.
        Inventario::factory()->count(3)->create();
    }
}
