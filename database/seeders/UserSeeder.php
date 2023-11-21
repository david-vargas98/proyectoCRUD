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
            'name' => 'edgarAdmin',
            'email'=> 'edgar@admin.com',
            'password'=> bcrypt('1234'),
        ])->assignRole('admin'); //Se asigna el rol de admin
        User::create([
            'name' => 'edgarAministrativo',
            'email'=> 'edgar@administrativo.com',
            'password'=> bcrypt('1234'),
        ])->assignRole('administrativo'); //Se asigna el rol de admin
        User::create([
            'name' => 'edgarPsicologo',
            'email'=> 'edgar@psicologo.com',
            'password'=> bcrypt('1234'),
        ])->assignRole('psicologo'); //Se asigna el rol de admin
        //Se usa el modelo User para crear 10 registros fictios usando factories
        User::factory()->count(10)->create();
    }
}
