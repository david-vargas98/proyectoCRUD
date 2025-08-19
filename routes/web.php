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
//Ruta para url base "/", ingresando a esta URL base, devuelve la vista "welcome"
Route::get('/', function () {
    return view('welcome');
});
//Rutas protegidas con middleware de autenticación y verificación de correo
Route::middleware([
    'auth:sanctum', //autenticación mediante el sistema Sanctum (basado en tokens)
    config('jetstream.auth_session'), //gestión de sesiones de autenticación
    'verified', // verificación de correo electrónico antes de acceder a las rutas
])->group(function () { //Lo anterior se aplica al siguiente grupo de rutas
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    //Se crea una nueva ruta para acceder a la vista creada
    Route::get('/profile', [UsuarioController::class, 'profile']);
});
