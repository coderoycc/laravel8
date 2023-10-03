<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;

class RecetaController extends Controller
{
    public function show($idReceta){
        $receta = Receta::find($idReceta);
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('consulta.receta', compact('receta'));
        $pdf->setPaper('half-letter','portrail'); //396x612
        $pdf->set_option('defaultFont', 'Helvetica');
        return $pdf->stream();
    }
}
