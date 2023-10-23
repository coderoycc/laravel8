<?php

namespace App\Http\Controllers;

use App\Models\Evolucion;
use App\Models\Historial\HistorialModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvolucionController extends Controller {

  public function index() {
    //
  }


  public function show($idHistorial) {
    $historial = HistorialModel::where('idHistorial', $idHistorial)->get()->first();
    $idUsuario = $historial->paciente->idUsuario;
    $evolucion = Evolucion::where('idPaciente', $idUsuario)->get()->first();
    $tratamiento = $evolucion->tratamientoActual();
    $mostrarMedicamentos = $tratamiento->tieneMedicamentos == 'NO' ? true : false;
    $html = '';
    $arrFechas = [];
    if($mostrarMedicamentos){
      $medicamentos = DB::select('SELECT * FROM tblmedicamento;');
      $html = '<option value="0" selected>-- Seleccione Medicamento --</option>';
      foreach ($medicamentos as $value) {
        $html .= '<option value="'.$value->idMedicamento.'">'.$value->descripcion.'</option>';
      }
    }else{
      $fechaInicio = strtotime($tratamiento->fechaInicio);
      $fechaFinal = strtotime($tratamiento->fechaInicio.'+20 days');
      $hoy = strtotime(date('Y-m-d'));
      if($hoy > $fechaInicio){
        $fechaInicio = $hoy;
      }
      $arrFechas[] = date('d-m-Y', $fechaInicio);
      $fechaActual = $fechaInicio;
      for($i = 1; $i < 6; $i++){
        if($fechaActual < $fechaFinal){
          $fechaActual = strtotime(date('d-m-Y',$fechaActual).'+1 days');
          $arrFechas[] = date('d-m-Y', strtotime(date('d-m-Y',$fechaInicio)."+$i days"));
        } else {
          break;
        } 
      }
    }
    return view('evolucion.index', compact('historial', 'evolucion', 'tratamiento', 'html', 'mostrarMedicamentos','arrFechas'));
  }


  public function edit(Evolucion $evolucion) {
    //
  }


  public function update(Request $request, Evolucion $evolucion) {
    //
  }


  public function destroy(Evolucion $evolucion) {
    //
  }
}
