<?php

use App\Http\Controllers\InsumoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//El "resorce" es un estándar que sirve para crear las rutas de nuestra tabla
Route::resource('inventario', InventarioController::class)->middleware('auth');
//1er método: Se usa middleware en la ruta directa para pedir autentificación del usuario
//Esta opción aplica el middleware de autenticación (auth) a todas las rutas generadas por el resource controller (InventarioController).
//Esto significa que para acceder a cualquier acción dentro del controlador de inventario, el usuario debe estar autenticado. Si un usuario no autenticado intenta acceder, será redirigido al inicio de sesión.

//Se agrega la madre esta del controlador *INVESTIGAR*
Route::resource('insumo', InsumoController::class);

//2do método: Otra forma, es decirle a un grupo de rutas que usen un middleware
//Route::middleware('auth')->group(function(){
//... Aquí van las rutas protegidas por autenticación 
//});
//Esta opción crea un grupo de rutas que están protegidas por el middleware de autenticación. Dentro del grupo, todas las rutas requerirán que el usuario esté autenticado para acceder a ellas. Es útil cuando tienes un conjunto específico de rutas que deben estar protegidas.

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    //Se crea una nueva ruta para acceder a la vista creada
    Route::get('/profile', [UsuarioController::class, 'profile']);
});
