<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //Después de crear el seeder, se necesita registrar en el archivo DatabaseSeeder.php. Esto se hace para que cuando se ejecute el comando php artisan db:seed, Laravel sepa qué seeders deben ejecutarse.
        $this->call([
            //Se agrega NormaSeeder::class al arreglo de seeders que se ejecutarán cuando se ejecute php artisan db:seed.
            InventarioSeeder::class,
        ]);
    }
}
