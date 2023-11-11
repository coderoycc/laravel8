<?php

use App\Http\Controllers\AltaController;
use App\Http\Controllers\RecetaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Historial;
use App\Http\Controllers\InternacionController;
use App\Http\Controllers\Medico;
use App\Http\Controllers\Paciente;
use App\Http\Controllers\MispacientesController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\TratamientoController;

Route::get('/', function () {
  return view('admin.index');
});
Route::get('admin/password', function () {
  $user = Auth::user();
  return view('admin.password', compact('user'));
});
Route::get('admin/profile', function () {
  $user = Auth::user();
  return view('admin.profile', compact('user'));
});

Route::put('admin/password/change', 'App\Http\Controllers\HomeController@cambiarPassword');

Route::put('admin/password/reset', 'App\Http\Controllers\HomeController@resetearPassword');

// Rutas para Medicos
Route::resource('medico', Medico::class)->names('medico');
Route::get('medico/{especialidad}', 'Medico@medicoespecialidad');
Route::put('medico/baja/status', [Medico::class, 'darBaja']);
Route::get('medico/baja/list', [Medico::class, 'bajasList'])->name('medico.baja.list');

// Rutas para Pacientes
Route::resource('paciente', Paciente::class)->names('paciente');
Route::get('paciente/nuevos', 'Paciente@nuevos')->name('paciente.nuevos');
Route::get('paciente/medico', 'Paciente@medico')->name('paciente.medico');
Route::get('paciente/evolucion/show', 'App\Http\Controllers\Paciente@evolucion')->name('paciente.evolucion');
Route::get('paciente/calendar/show', 'App\Http\Controllers\Paciente@calendar')->name('paciente.calendar');
Route::put('paciente/baja/status', [Paciente::class, 'darBaja']);
Route::get('paciente/baja/list', [Paciente::class, 'bajasList'])->name('paciente.baja.list');

Route::get('mispacientes', [MispacientesController::class, 'index'])->name('mispacientes.index');
Route::get('mispacientes/nuevos', [MispacientesController::class, 'nuevos'])->name('mispacientes.nuevos');


// Rutas para controlador Historial
Route::resource('historial', Historial::class)->names('historial');
Route::get('historial/{historial}', [Historial::class, 'edit'])->name('historial.edit');

// Rutas para consultas
Route::get('consulta/{idHistorial}', [ConsultaController::class, 'create'])->name('consulta.create');
Route::get('consulta/list/{idHistorial}', [ConsultaController::class, 'list'])->name('consulta.list');
Route::post('consulta/store', [ConsultaController::class, 'store'])->name('consulta.store');

Route::get('consulta/me/list', [ConsultaController::class, 'misconsultas'])->name('consulta.misconsultas'); // usuarios

Route::get('evolucion/{idHistorial}/show', 'App\Http\Controllers\EvolucionController@show')->name('evolucion.show');

Route::post('evolucion/insertDelete/appTrat', 'App\Http\Controllers\AplicacionTratController@insertDeleteApTrat');

Route::post('tratamiento/create', [TratamientoController::class, 'create']);
Route::post('tratamiento/create/intratecales', [TratamientoController::class, 'createIntratecales']);

Route::get('internacion', [InternacionController::class, 'index'])->name('internacion.index');
Route::get('internacion/solicitudes', [InternacionController::class, 'solicitud'])->name('internacion.solicitud');
Route::post('internacion/create', [InternacionController::class, 'create'])->name('internacion.create');
Route::put('internacion/update', [InternacionController::class, 'update'])->name('internacion.update');
Route::get('internacion/formulario/{idInternacion}', [InternacionController::class, 'formulario'])->name('internacion.formulario');
Route::put('altamedica/internacion/update', 'App\Http\Controllers\AltaController@altamedica');
Route::get('altamedica/formulario/{idInternacion}', 'App\Http\Controllers\AltaController@formulario');

Route::get('reports/html/leucemia', 'App\Http\Controllers\ReportsController@reportleucemia')->name('reports.leucemia');
Route::get('reports/html/tumor', 'App\Http\Controllers\ReportsController@reportTumor')->name('reports.tumor');
Route::get('reports/pdf/leucemia', 'App\Http\Controllers\ReportsController@reportleucemiaPdf')->name('reports.leucemia.pdf');

Route::get('receta/{idReceta}', [RecetaController::class, 'show'])->name('receta.show');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Ruta de Prueba para el Armado de PDF
Route::get('/report/{idPaciente}/show', [Paciente::class, 'ProtocolSTJudePDF'])->name('report');

Route::get('/report/{idPaciente}/show/{idTratamiento}', [Paciente::class, 'ProtocolSTJudeTrat']);
