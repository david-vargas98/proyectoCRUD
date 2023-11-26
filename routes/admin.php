<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\InsumoController;
use App\Http\Controllers\InventarioController;
use App\Models\UserAction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;  //Se incluye el controlador que se creó para admin
use App\Http\Controllers\Admin\UserController;  //Se incluye el controlador de usuarios

//Se asigna el control de la ruta al controlador
route::get('', [HomeController::class,'index'])->name('admin.home');

//Ruta para el desbloqueo:
//match se usa para definir una ruta que responde a varios métodos HTTP, then la url, el controlador, nombre del método y el nombre de la ruta
route::match(['put', 'patch'],'users/{user}/desbloqueo', [UserController::class, 'desbloqueo'])->name('admin.users.desbloqueo');

//Ruta para quitar todos los roles
route::match(['put', 'patch'],'admin/users/{user}/removeAllRoles', [UserController::class, 'removeAllRoles'])->name('admin.users.removeAllRoles');
//Grupo de rutas para usuarios y se les da nombre
route::resource('users', UserController::class)->only(['index', 'edit', 'update'])->names('admin.users');

//El "resorce" es un estándar que sirve para crear las rutas de nuestra tabla
Route::resource('inventario', InventarioController::class)->middleware('auth');

//Se agrega la madre esta del controlador *INVESTIGAR*
Route::resource('insumo', InsumoController::class);

//Se agrega el controlador para el crud de permisos, la url inicia en 'roles', administrado por RoleController
Route::resource('roles', RoleController::class)->names('admin.roles'); //se le da nombre de rutas

//Ruta para mostrar la tabla de acciones realizadas por usuarios:

//Se define una ruta de tipo get para acceder a la url userActions
Route::get('userActions', function () { //El controlador es la función anónima
    //recupera los registros de la tabla user_actions ordenados por la columna created_at de manera descendente con latest()
    $userActions = UserAction::latest()->get();
    //Después de obtener los registros, se retorna la vista partials.user_actions_table y se pasa la variable $userActions
    return view('partials.user_actions_table', compact('userActions'));
})->name('admin.useractions.index')->middleware('can:admin.useractions.index'); //Se asigna un nombre a la ruta