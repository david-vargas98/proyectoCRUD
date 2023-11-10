<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ClienteUserController;
use Illuminate\Support\Facades\Route;
//Rutas del controlador de clientes
Route::resource('clientes', ClienteController::class)->names('empleado.clientes');
//Rutas del controlador de proyectos
Route::resource('proyectos', ClienteUserController::class)->names('empleado.proyectos');