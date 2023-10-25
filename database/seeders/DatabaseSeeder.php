<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Inventario;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Se pobla la base de datos con los siguientes seeders:
        //Esto está utilizando un factory para crear 5 instancias de la clase User. Cada uno de estos usuarios tendrá asociadas 2 instancias de la clase Norma.
        User::factory(5)->has(Inventario::factory()->count(2))->create();

        //Esto crea una única instancia de la clase User con un nombre y correo electrónico específicos ('Test User' y 'test@example.com' respectivamente). Este usuario tendrá asociadas 5 instancias de la clase Inventario.
        User::factory()->has(Inventario::factory()->count(5))->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '12345678',
        ]);

        //Después de crear el seeder, se necesita registrar en el archivo DatabaseSeeder.php. Esto se hace para que cuando se ejecute el comando php artisan db:seed, Laravel sepa qué seeders deben ejecutarse.
        //$this->call([
        //    //Se agrega NormaSeeder::class al arreglo de seeders que se ejecutarán cuando se ejecute php artisan db:seed.
        //    InventarioSeeder::class,
        //]);
    }
}
