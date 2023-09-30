<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Historial;
use App\Http\Controllers\InternacionController;
use App\Http\Controllers\Medico;
use App\Http\Controllers\Paciente;
use App\Http\Controllers\MispacientesController;



Route::get('/', function () {
  return view('admin.index');
});
// Rutas para Medicos
Route::resource('medico', Medico::class)->names('medico');
Route::get('medico/{especialidad}', 'Medico@medicoespecialidad');

// Rutas para Pacientes
Route::resource('paciente', Paciente::class)->names('paciente');
Route::post('internacion/create', [InternacionController::class, 'create'])->name('internacion.create');

Route::get('mispacientes', [MispacientesController::class,'index'])->name('mispacientes.index');
Route::get('mispacientes/nuevos', [MispacientesController::class,'nuevos'])->name('mispacientes.nuevos');

Route::get('paciente/nuevos', 'Paciente@nuevos')->name('paciente.nuevos');
Route::get('paciente/medico', 'Paciente@medico')->name('paciente.medico');
Route::get('paciente/evolucion', 'Paciente@evolucion')->name('paciente.evolucion');

// Rutas para controlador Historial
Route::resource('historial', Historial::class)->names('historial');
Route::get('historial/{historial}', [Historial::class,'edit'])->name('historial.edit');


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Ruta de Prueba para el Armado de PDF
Route::get('/report', [App\Http\Controllers\Paciente::class, 'ProtocolSTJudePDF'])->name('report');