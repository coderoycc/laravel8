<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Historial;
use App\Http\Controllers\Medico;
use App\Http\Controllers\Paciente;




Route::get('/', function () {
  return view('admin.index');
});
// Rutas para Medicos
Route::resource('medico', Medico::class)->names('medico');
Route::get('medico/{especialidad}', 'Medico@medicoespecialidad');

// Rutas para Pacientes
Route::resource('paciente', Paciente::class)->names('paciente');

Route::get('paciente/nuevos', 'Paciente@nuevos')->name('paciente.nuevos');
Route::get('paciente/medico', 'Paciente@medico')->name('paciente.medico');
Route::get('paciente/evolucion', 'Paciente@evolucion')->name('paciente.evolucion');

// Rutas para controlador Historial
Route::resource('historial', Historial::class)->names('historial');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');