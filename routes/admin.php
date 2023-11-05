<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;  //Se incluye el controlador que se creó para admin
use App\Http\Controllers\Admin\UserController;  //Se incluye el controlador de usuarios

//Se asigna el control de la ruta al controlador
route::get('', [HomeController::class,'index'])->name('admin.home');

//Grupo de rutas para usuarios y se les da nombre
route::resource('users', UserController::class)->names('admin.users');