<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;  //Se incluye el controlador que se creó para admin

//Se asigna el control de la ruta al controlador
route::get('', [HomeController::class,'index'])->name('admin.home');