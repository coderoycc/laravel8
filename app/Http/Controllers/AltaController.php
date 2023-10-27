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
}
