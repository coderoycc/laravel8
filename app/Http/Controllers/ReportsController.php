<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller {
  public function reportleucemia(Request $request) {
    $year = date("Y");
    $data = [
      'labels' => ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
      'data' => [12, 19, 3, 5, 2],
    ];
    $leucemia = DB::select("SELECT tu.genero, tfn.idDiagnosticoCIE, tfn.descripcion, count(*) cantidad FROM tblusuario tu
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

    $totales = array();
    $valores = array();
    foreach ($leucemia as $valor) {
      if(!isset($valores[$valor->idDiagnosticoCIE])) {
        $valores[$valor->idDiagnosticoCIE] = ['descripcion' => $valor->descripcion, 'total'=>0];
      }
      if($valor->genero == 'M'){
        $valores[$valor->idDiagnosticoCIE]['M'] = $valor->cantidad;
        if(!isset($valores[$valor->idDiagnosticoCIE]['F'])){
          $valores[$valor->idDiagnosticoCIE]['F'] = 0;
        }
      }elseif($valor->genero == 'F'){
        $valores[$valor->idDiagnosticoCIE]['F'] = $valor->cantidad;
        if(!isset($valores[$valor->idDiagnosticoCIE]['M'])){
          $valores[$valor->idDiagnosticoCIE]['M'] = 0;
        }
      }
      $valores[$valor->idDiagnosticoCIE]['total'] += $valor->cantidad;
    }
    
    $dataMeses = DB::select("SELECT tu.genero, tmp.mes, count(*) cantidad
    FROM tblUsuario tu 
    INNER JOIN (
      SELECT Month(th.fechaRegistro) mes, th.idPaciente FROM tbldiagnosticospaciente tdp
      INNER JOIN (
        SELECT codigo_cie, descripcion FROM tbldiagnosticocie WHERE descripcion LIKE '%leucemia%'
      ) tmp
      ON tmp.codigo_cie = tdp.idDiagnosticoCIE
      INNER JOIN tblhistorial th ON th.idHistorial = tdp.idHistorial
      WHERE th.fechaRegistro BETWEEN '".$year."-01-01' AND '".$year."-12-31'
    ) tmp
    ON tmp.idPaciente = tu.idUsuario 
    GROUP BY tmp.mes, tu.genero;");
    $meses = array();
    foreach ($dataMeses as $reg) {
      
      if(!isset($meses[$reg->mes])){
        $meses[$reg->mes] = array('F'=>0, 'M'=>0);
      }
      $meses[$reg->mes][$reg->genero] = $reg->cantidad;
      
    }
    return view('reports.leucemia', compact('data', 'valores', 'meses'));
  }

  public function reportleucemiaPdf(){
    $pdf = app('dompdf.wrapper');
    // Asignando la vista de referencia del documento
    $pdf->loadView('reports.leucemiaPdf');
    $pdf->setPaper('letter', 'portrail');
    // Definiendo el tipo de fuente
    $pdf->set_option('defaultFont', 'Helvetica');
    return $pdf->stream();
  }

  public function reportTumor(Request $request){
    echo 'adios';
  }

  public function reportAltas(Request $request) {

  }
}

