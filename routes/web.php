<?php

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