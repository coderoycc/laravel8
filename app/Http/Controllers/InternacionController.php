<?php

namespace App\Http\Controllers;

use App\Models\Internacion;
use Illuminate\Http\Request;

class InternacionController extends Controller{
  public function create(Request $request){
    try {
      date_default_timezone_set('America/La_Paz');
      
      if(!isset($request['idPaciente'])){
        throw new \Exception("Error no exista el valor esperado idPaciente", 1);
      }
      $motivo = isset($request['motivo']) ? $request['motivo'] : '';
      $indicaciones = isset($request['indicaciones']) ? $request['indicaciones'] : '';
      $idPaciente = $request['idPaciente'];
      $idMedico = $request['idMedico'];
      $data = array('motivo'=>$motivo, 'indicaciones'=>$indicaciones, 'idPaciente'=>$idPaciente, 'idMedico'=>$idMedico);
      Internacion::create($data);
      echo json_encode(array('status'=>'success', 'message'=>'Solicitud realizada con éxito'));
    } catch (\Throwable $th) {
      echo json_encode(array('status'=>'error', 'message'=>$th->getMessage()));
    }

  }
}
