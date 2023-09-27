<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Historial;
use App\Http\Controllers\Medico;
use App\Http\Controllers\Paciente;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // $users = App\Models\Historial\Historial::all();
    return view('admin.index');
});
Route::get('admin/password', function () {
    // $users = App\Models\Historial\Historial::all();
    return view('admin.password');
});

// Rutas para Medicos
Route::resource('medico', Medico::class)->names('medico');

// Rutas para Pacientes
Route::resource('paciente', Paciente::class)->names('paciente');

Route::get('paciente/nuevos', 'Paciente@nuevos')->name('paciente.nuevos');
Route::get('paciente/medico', 'Paciente@medico')->name('paciente.medico');
Route::get('paciente/evolucion', 'Paciente@evolucion')->name('paciente.evolucion');

// Rutas para controlador Historial
Route::resource('historial', Historial::class)->names('historial');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
