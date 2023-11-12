<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ClienteUserController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
//Rutas del controlador de clientes
Route::resource('clientes', ClienteController::class)->names('empleado.clientes')->middleware(Authenticate::class);
//Rutas del controlador de proyectos
Route::resource('asociaciones', ClienteUserController::class)->names('empleado.asociaciones')->parameters(['asociaciones' => 'asociacion'])->except('show')->middleware(Authenticate::class);