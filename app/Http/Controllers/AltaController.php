<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Internacion;


class AltaController extends Controller {
  public function formulario($idInternacion){
    $internacion = Internacion::find($idInternacion);
    $pdf = app('dompdf.wrapper');
    $pdf->loadView('altamedica.alta', compact('internacion'));
    $pdf->setPaper('letter','portrail'); //396x612
    $pdf->set_option('defaultFont', 'Helvetica');
    return $pdf->stream();
  }
  public function altamedica(Request $request){
    date_default_timezone_set('America/La_Paz');
    try {
      $data = $request->all();
      $internacion = Internacion::find($data['idInternacion']);
      $internacion->estado = 'ALTA';
      $internacion->fechaEgreso = date('Y-m-d');
      $internacion->observacionEgreso = $data['observaciones'];
      $internacion->motivoEgreso = $data['motivo_alta'];
      $internacion->save();
      return response()->json(['status' => 'success', 'idInternacion'=> $internacion->idInternacion]);
    } catch (\Throwable $th) {
      return response()->json(['status' => 'error', 'error'=> json_encode($th)]);
    }
    
  }
}
