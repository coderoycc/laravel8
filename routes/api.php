<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('medico/{especialidad}', 'App\Http\Controllers\RequestController@medicoespecialidad');
Route::get('medicamento/{cadena}', 'App\Http\Controllers\RequestController@medicamento');
Route::get('internacion/{id}', 'App\Http\Controllers\InternacionController@data');
Route::get('calendar/paciente', 'App\Http\Controllers\RequestController@calendarpac');
Route::get('ensala/medico', 'App\Http\Controllers\RequestController@pacientesenSala');
Route::put('ensala/cambiarEstado', 'App\Http\Controllers\RequestController@cambiarEstado');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
