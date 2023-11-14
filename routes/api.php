<?php

use App\Models\ClienteUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/asociaciones', function () {
    //Con esto se devuelve un JSON explícito para claridad y consistencia en la respuesta
    return response()->json([
        'mensaje' => 'Lista de asociaciones',
        'información' => ClienteUser::all(),
    ], 200); //Es el código de estado de éxito en la respuesta, sino se pone laravel lo asume
});
