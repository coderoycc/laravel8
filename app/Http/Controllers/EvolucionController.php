<?php

namespace App\Http\Controllers;

use App\Models\Evolucion;
use App\Models\Historial\HistorialModel;
use Illuminate\Http\Request;

class EvolucionController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    //
  }

  public function show($idHistorial) {
    $historial = HistorialModel::where('idHistorial', $idHistorial)->get()->first();
    return view('evolucion.index', compact('historial'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Evolucion  $evolucion
   * @return \Illuminate\Http\Response
   */
  public function edit(Evolucion $evolucion) {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Evolucion  $evolucion
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Evolucion $evolucion) {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Evolucion  $evolucion
   * @return \Illuminate\Http\Response
   */
  public function destroy(Evolucion $evolucion) {
    //
  }
}
