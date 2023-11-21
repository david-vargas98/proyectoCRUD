<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ClienteUserController;
use App\Http\Controllers\MilitaryElementsController;
use App\Http\Controllers\PatientController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
//Rutas del controlador de clientes
Route::resource('clientes', ClienteController::class)->names('empleado.clientes')->middleware(Authenticate::class);
//Como es una ruta parte de asociaciones, pero no directamente de resource, se recomienda ponerlas antes:
//'asociaciones/archivos' es la URL, y 'descargar' es como se llama el método en el controlador, es al que llama :D
Route::get('asociaciones/archivos/{asociacion}', [ClienteUserController::class, 'descargar'])->name('empleado.asociaciones.descarga');
//Se crea otra ruta para poder acceder al contrato, o bien, solo verlo
Route::get('asociaciones/verArchivos/{asociacion}', [ClienteUserController::class, 'ver'])->name('empleado.asociaciones.ver');
//Rutas del controlador de asociaciones
Route::resource('asociaciones', ClienteUserController::class)->names('empleado.asociaciones')->parameters(['asociaciones' => 'asociacion'])->middleware(Authenticate::class);

//Pegasus
//Rutas para las funcionalidades del personal administrativo
Route::resource('administrativo/elementosMilitares', MilitaryElementsController::class)->parameters(['elementosMilitares' => 'elemento']); //Se modifica el parameters para modificar el nombre de la variable que espera
//Para desginar elementos a pacientes
Route::resource('administrativo/pacientes', PatientController::class);

//Ruta para la descarga del archivo de citas
route::get('psicologo/citas/descargaArchivos/{cita}', [AppointmentController::class, 'descargar'])->name('citas.descargar');
//Ruta para la visualización del archivo de citas
route::get('psicologo/citas/verArchivos/{cita}', [AppointmentController::class, 'ver'])->name('citas.ver');
//Rutas para las citas
Route::resource('psicologo/citas', AppointmentController::class);