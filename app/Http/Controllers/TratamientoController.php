<?php

namespace App\Http\Controllers;

use App\Models\ContenidoTrat;
use App\Models\Tratamiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TratamientoController extends Controller {
  public function create(Request $request) {
    try {
      $cadMedicamento = 'idMedicamento';
      $cadDosis = 'dosis';
      $idTratamiento = $request->idTratamiento;
      $tratamiento = Tratamiento::find($idTratamiento);
      if ($tratamiento->tieneMedicamentos == 'NO') {
        $tratamiento->tieneMedicamentos = 'SI';
        $tratamiento->fechaInicio = $request->fechaInicio;
        $tratamiento->save();
        for ($i = 1; $i <= 6; $i++) {
          if ($request->{$cadMedicamento . $i} != 0) {
            $data = ['idTratamiento' => $idTratamiento, 'idMedicamento' => $request->{$cadMedicamento . $i}, 'dosis' => $request->{$cadDosis . $i}];
            ContenidoTrat::create($data);
          }
        }
        echo json_encode(['status' => 'success', 'message' => 'Tratamiento creado correctamente.']);
      }
    } catch (\Throwable $th) {
      echo json_encode(['status' => 'error', 'message' => 'Error al crear el tratamiento.' . json_encode($th)]);
    }
  }

  public function createIntratecales(Request $request){
    try {
      $cadIntra = 'idIntra'; // idMedicamento
      $cadDosis = 'dosisIntra';
      $idTratamiento = $request->idTratamiento;
      $tratamiento = Tratamiento::find($idTratamiento);
      $data = [];
      if ($tratamiento->conIntratecales == 'NO') {
        $tratamiento->conIntratecales = 'SI';
        $tratamiento->save();
        for ($i = 1; $i <= 3; $i++) {
          if ($request->{$cadIntra . $i} != 0) {
            $data[] = ['idTratamiento' => $idTratamiento, 'idMedicamento' => $request->{$cadIntra . $i}, 'dosis' => $request->{$cadDosis . $i}];
          }
        }
        $res = DB::table('tblintratecales')->insert($data);
        if($res){
          echo json_encode(['status' => 'success', 'message' => 'Intratecales creadas correctamente.']);
        }else{
          echo json_encode(['status' => 'error', 'message' => 'Error al crear las intratecales.']);
        }
      }
    } catch (\Throwable $th) {
      echo json_encode(['status' => 'error', 'message' => 'Error al crear intratecales tratamiento.' . json_encode($th)]);
    }
  }
}
