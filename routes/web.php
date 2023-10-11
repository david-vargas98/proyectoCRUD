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
Route::resource('inventario', InventarioController::class); //php artisan route:list para verlas

//Se agrega la madre esta del controlador *INVESTIGAR*
Route::resource('insumo', InsumoController::class);

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
