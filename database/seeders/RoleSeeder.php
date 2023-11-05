<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; //Se importa el modelo para los roles

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Se crea un nuevo registro de roles
        $roleOne = Role::create(['name' =>'admin']);
        $roleDos = Role::create(['name' =>'cliente']);
    }
}
