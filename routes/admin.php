<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\InsumoController;
use App\Http\Controllers\InventarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;  //Se incluye el controlador que se creó para admin
use App\Http\Controllers\Admin\UserController;  //Se incluye el controlador de usuarios

//Se asigna el control de la ruta al controlador
route::get('', [HomeController::class,'index'])->name('admin.home');

//Grupo de rutas para usuarios y se les da nombre
route::resource('users', UserController::class)->only(['index', 'edit', 'update'])->names('admin.users');

//El "resorce" es un estándar que sirve para crear las rutas de nuestra tabla
Route::resource('inventario', InventarioController::class)->middleware('auth');

//Se agrega la madre esta del controlador *INVESTIGAR*
Route::resource('insumo', InsumoController::class);

//Se agrega el controlador para el crud de permisos, la url inicia en 'roles', administrado por RoleController
Route::resource('roles', RoleController::class)->names('admin.roles'); //se le da nombre de rutas