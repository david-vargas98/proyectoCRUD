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
        $roleTwo = Role::create(['name' =>'empleado']);
        $roleThree = Role::create(['name' =>'cliente']);

        //Permiso para la ruta de los usuarios
        Permission::create(['name' => 'admin.users.index', 'description' => 'Ver el índice de usuarios'])->assignRole($roleOne);
        Permission::create(['name' => 'admin.users.edit', 'description' => 'Editar los permisos de los usuarios'])->assignRole($roleOne);
        //Permiso para la ruta dashboard
        Permission::create(['name' => 'dashboard', 'description' => 'Ver el dashboard'])->syncRoles([$roleOne, $roleTwo]); //Se asignan permisos

        //Permisos para las rutas de inventarios
        Permission::create(['name' => 'inventario.index', 'description' => 'Ver el índice de los inventarios'])->syncRoles([$roleOne, $roleTwo]);
        Permission::create(['name' => 'inventario.create', 'description' => 'Agregar nuevos inventarios'])->assignRole($roleOne);
        Permission::create(['name' => 'inventario.edit', 'description' => 'Editar inventarios existente'])->assignRole($roleOne);
        Permission::create(['name' => 'inventario.destroy', 'description' => 'Eliminar inventarios'])->assignRole($roleOne);

        //Permisos para las rutas de insumos
        Permission::create(['name' => 'insumo.index', 'description' => 'Ver el índice de los insumos'])->syncRoles([$roleOne, $roleTwo]);
        Permission::create(['name' => 'insumo.create', 'description' => 'Agregar nuevos insumos'])->assignRole($roleOne);
        Permission::create(['name' => 'insumo.edit', 'description' => 'Editar insumos existente'])->assignRole($roleOne);
        Permission::create(['name' => 'insumo.destroy', 'description' => 'Eliminar inventarios'])->assignRole($roleOne);
    }
}
