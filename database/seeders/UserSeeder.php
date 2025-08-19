<?php

namespace Database\Seeders;

use App\Models\User;  //Se agrega el recurso del modelo
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Se crea un registro que siempre será admin
        User::create([
            'name' => 'edgar',
            'email'=> 'edgar@edgar.com',
            'password'=> bcrypt('12345678'),
        ])->assignRole('admin'); //Se asigna el rol de admin
        //Se usa el modelo User para crear 10 registros fictios usando factories
        User::factory()->count(10)->create();
    }
}
