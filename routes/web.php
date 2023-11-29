<?php

use App\Http\Controllers\InsumoController;
use App\Http\Controllers\UsuarioController;
use App\Models\Patient;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarioController;
use App\Models\Appointment;
use App\Models\MilitaryElements;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        //Se obtiene el total de personal militar
        $totalPersonalMilitar = MilitaryElements::all();
        //Se obtiene el total de pacientes
        $totalPacientes = Patient::all();
        //Se obtiene el total de citas
        $totalCitas = Appointment::all();
        return view('dashboard', compact('totalPersonalMilitar', 'totalPacientes', 'totalCitas'));
    })->name('dashboard');
    //Se crea una nueva ruta para acceder a la vista creada
    Route::get('/profile', [UsuarioController::class, 'profile']);
});
