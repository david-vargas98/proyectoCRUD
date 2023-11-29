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
        $roleTwo = Role::create(['name' =>'administrativo']);
        $roleThree = Role::create(['name' =>'psicólogo']);

        //Permiso para las rutas de los usuarios (solo admin)
        Permission::create(['name' => 'admin.users.index', 'description' => 'Ver y buscar en el listado de usuarios'])->assignRole($roleOne);
        Permission::create(['name' => 'admin.users.edit', 'description' => 'Editar los permisos de los usuarios'])->assignRole($roleOne);
        //Permiso para la ruta dashboard (los tres roles)
        Permission::create(['name' => 'dashboard', 'description' => 'Ver el dashboard'])->syncRoles([$roleOne, $roleTwo, $roleThree]); //Se asignan permisos

        //Permisos para las rutas de los roles (Solo admin)
        Permission::create(['name' => 'admin.roles.index', 'description' => 'Ver y buscar en el listado de roles'])->assignRole($roleOne);
        Permission::create(['name' => 'admin.roles.create', 'description' => 'Crear nuevos roles'])->assignRole($roleOne);
        Permission::create(['name' => 'admin.roles.edit', 'description' => 'Editar roles'])->assignRole($roleOne);
        Permission::create(['name' => 'admin.roles.destroy', 'description' => 'Borrar roles'])->assignRole($roleOne);

        //Permisos para las rutas de acciones de usuarios (solo admin)
        Permission::create(['name' => 'admin.useractions.index', 'description' => 'Ver y buscar en el listado de acciones realizadas por los usuarios'])->assignRole($roleOne);

        //Permisos para las rutas de elementos militares (admin puede todo, administrativo todo y psicólogo solo ver)
        Permission::create(['name' => 'elementosMilitares.index', 'description' => 'Ver y buscar en el listado de elementos militares'])->syncRoles([$roleOne, $roleTwo, $roleThree]);
        Permission::create(['name' => 'elementosMilitares.create', 'description' => 'Crear registros de elementos militares'])->syncRoles([$roleOne, $roleTwo]);
        Permission::create(['name' => 'elementosMilitares.edit', 'description' => 'Editar registros de elementos militares'])->syncRoles([$roleOne, $roleTwo]);
        Permission::create(['name' => 'elementosMilitares.show', 'description' => 'Ver detalles de los registros de elementos militares'])->syncRoles([$roleOne, $roleTwo, $roleThree]);
        Permission::create(['name' => 'elementosMilitares.destroy', 'description' => 'Borrar registros de elementos militares'])->syncRoles([$roleOne, $roleTwo]);

        //Permisos para las rutas de pacientes (admin puede todo, administrativo todo y psicólogo ver, incluyendo actividades)
        Permission::create(['name' => 'pacientes.index', 'description' => 'Ver y buscar en el listado de pacientes'])->syncRoles([$roleOne, $roleTwo, $roleThree]);
        Permission::create(['name' => 'pacientes.create', 'description' => 'Crear registros de pacientes'])->syncRoles([$roleOne, $roleTwo]);
        Permission::create(['name' => 'pacientes.edit', 'description' => 'Editar registros de pacientes'])->syncRoles([$roleOne, $roleTwo]);
        Permission::create(['name' => 'pacientes.show', 'description' => 'Ver detalles de los registros de pacientes'])->syncRoles([$roleOne, $roleTwo, $roleThree]);
        Permission::create(['name' => 'pacientes.destroy', 'description' => 'Borrar registros de pacientes'])->syncRoles([$roleOne, $roleTwo]);

        //Permisos para las rutas de citas (admin puede todo, administrativo ver y psicólogo todo)
        Permission::create(['name' => 'citas.index', 'description' => 'Ver y buscar en el listado de citas'])->syncRoles([$roleOne, $roleTwo, $roleThree]);
        Permission::create(['name' => 'citas.create', 'description' => 'Crear registros de citas'])->syncRoles([$roleOne, $roleThree]);
        Permission::create(['name' => 'citas.edit', 'description' => 'Editar registros de citas'])->syncRoles([$roleOne, $roleThree]);
        Permission::create(['name' => 'citas.show', 'description' => 'Ver detalles de los registros de citas'])->syncRoles([$roleOne, $roleTwo, $roleThree]);
        Permission::create(['name' => 'citas.destroy', 'description' => 'Borrar registros de citas'])->syncRoles([$roleOne, $roleThree]);

        // //Permisos para las rutas de inventarios
        // Permission::create(['name' => 'inventario.index', 'description' => 'Ver el índice de los inventarios'])->syncRoles([$roleOne, $roleTwo]);
        // Permission::create(['name' => 'inventario.create', 'description' => 'Agregar nuevos inventarios'])->assignRole($roleOne);
        // Permission::create(['name' => 'inventario.edit', 'description' => 'Editar inventarios existente'])->assignRole($roleOne);
        // Permission::create(['name' => 'inventario.destroy', 'description' => 'Eliminar inventarios'])->assignRole($roleOne);

        // //Permisos para las rutas de insumos
        // Permission::create(['name' => 'insumo.index', 'description' => 'Ver el índice de los insumos'])->syncRoles([$roleOne, $roleTwo]);
        // Permission::create(['name' => 'insumo.create', 'description' => 'Agregar nuevos insumos'])->assignRole($roleOne);
        // Permission::create(['name' => 'insumo.edit', 'description' => 'Editar insumos existente'])->assignRole($roleOne);
        // Permission::create(['name' => 'insumo.destroy', 'description' => 'Eliminar inventarios'])->assignRole($roleOne);

        // //Permisos para la ruta de clientes
        // Permission::create(['name' => 'empleado.clientes.index', 'description' => 'Ver el índice de los clientes'])->syncRoles([$roleOne, $roleTwo]);
        
        // //Permisos para la ruta de asociaciones
        // Permission::create(['name' => 'empleado.asociaciones.index', 'description' => 'Ver el índice de las asociaciones'])->syncRoles([$roleOne, $roleTwo]);

    }
}
