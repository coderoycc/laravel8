<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller {
  public function reportleucemia(Request $request) {
    $year = date("Y");
    DB::select("SELECT tu.genero, tfn.idDiagnosticoCIE, tfn.descripcion, count(*) cantidad FROM tblusuario tu
    INNER JOIN (
      SELECT tdp.idDiagnosticoCIE, tdp.idHistorial, tmp.descripcion, th.idPaciente FROM tbldiagnosticospaciente tdp
      INNER JOIN (
        SELECT codigo_cie, descripcion FROM tbldiagnosticocie WHERE descripcion LIKE '%leucemia%'
      ) tmp
      ON tmp.codigo_cie = tdp.idDiagnosticoCIE
      INNER JOIN tblhistorial th ON th.idHistorial = tdp.idHistorial
      WHERE th.fechaRegistro BETWEEN '".$year."-01-01' AND '".$year."-12-31'
    ) tfn
    ON tfn.idPaciente = tu.idUsuario
    GROUP BY tu.genero, tfn.idDiagnosticoCIE, tfn.descripcion;", []);

    
    return view('reports.leucemia');
  }

  public function reportTumor(Request $request){
    echo 'adios';
  }

  public function reportAltas(Request $request) {

  }
}

