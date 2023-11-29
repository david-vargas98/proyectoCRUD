<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Inventario;
use App\Models\MilitaryElements;
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
            'password' => bcrypt('12345678'),
        ]);

        //Se llama al seeder de Roles
        $this->call(RoleSeeder::class);
        //Se llama al seeder de usuarios
        $this->call(UserSeeder::class);

        //Se llama al seeder de insumos
        $this->call(InsumoSeeder::class);

        //Se llama al seeder de clientes
        $this->call(ClienteSeeder::class);

        //Se llama al seeder de asociaciones
        $this->call(ClienteUserSeeder::class);

        //Se llamm al seeder de la tabla lowSeverity
        // $this->call(LowSeveritySeeder::class);

        //Se llamm al seeder de la tabla MediumSeverity
        // $this->call(MediumSeveritySeeder::class);

        //Se llamm al seeder de la tabla HighSeverity
        // $this->call(HighSeveritySeeder::class);

        //Se llamm al seeder de la tabla MilitaryElements
        $this->call(MilitaryElementsSeeder::class);

        //Se llamm al seeder de la tabla Patient
        $this->call(PatientSeeder::class);

        //Se llamm al seeder de la tabla Patient
        $this->call(AppointmentSeeder::class);
    }
}
