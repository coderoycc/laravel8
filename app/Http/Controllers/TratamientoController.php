<?php

namespace App\Http\Controllers;

use App\Models\ContenidoTrat;
use Illuminate\Http\Request;

class TratamientoController extends Controller
{
  public function create(Request $request)
  {
    // print_r($request->all());
    try {
      $cadMedicamento = 'idMedicamento';
      $cadDosis = 'dosis';
      $idTratamiento = $request->idTratamiento;
      for ($i = 1; $i <= 6; $i++) { 
        if($request->{$cadMedicamento . $i} != 0) {
          $data = ['idTratamiento' => $idTratamiento, 'idMedicamento' => $request->{$cadMedicamento . $i}, 'dosis' => $request->{$cadDosis . $i}];
          ContenidoTrat::create($data);
        }
      }
      echo json_encode(['status' => 'success', 'message' => 'Tratamiento creado correctamente.']);
    } catch (\Throwable $th) {
      echo json_encode(['status' => 'error', 'message' => 'Error al crear el tratamiento.'. json_encode($th)]);
    }
  }
}