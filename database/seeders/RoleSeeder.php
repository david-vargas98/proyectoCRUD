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
        $roleTwo = Role::create(['name' =>'cliente']);

        //Permiso para la ruta dashboard
        Permission::create(['name' => 'dashboard'])->syncRoles([$roleOne]); //Se asignan permisos

        //Permisos para las rutas de inventarios
        Permission::create(['name' => 'inventario.index'])->assignRole($roleOne);
        Permission::create(['name' => 'inventario.create'])->assignRole($roleOne);
        Permission::create(['name' => 'inventario.edit'])->assignRole($roleOne);
        Permission::create(['name' => 'inventario.destroy'])->assignRole($roleOne);

        //Permisos para las rutas de insumos
        Permission::create(['name' => 'insumo.index'])->assignRole($roleOne);
        Permission::create(['name' => 'insumo.create'])->assignRole($roleOne);
        Permission::create(['name' => 'insumo.edit'])->assignRole($roleOne);
        Permission::create(['name' => 'insumo.destroy'])->assignRole($roleOne);
    }
}
