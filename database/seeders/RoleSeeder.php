<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; //Se importa el modelo para los roles
use Spatie\Permission\Models\Permission; //Se imorta el modelo para los permisos

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

        //Permiso para la ruta dashboard
        Permission::create(['name' => 'dashboard']);

        //Permisos para las rutas de inventarios
        Permission::create(['name' => 'inventario.index']);
        Permission::create(['name' => 'inventario.create']);
        Permission::create(['name' => 'inventario.edit']);
        Permission::create(['name' => 'inventario.destroy']);

        //Permisos para las rutas de insumos
        Permission::create(['name' => 'insumo.index']);
        Permission::create(['name' => 'insumo.create']);
        Permission::create(['name' => 'insumo.edit']);
        Permission::create(['name' => 'insumo.destroy']);
    }
}
