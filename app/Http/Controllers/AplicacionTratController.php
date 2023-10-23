<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AplicacionTratController extends Controller {
  public function insertDeleteApTrat(Request $request){
    try {
      $dataDelete = json_decode($request->dataDelete);
      $registros = array_map(function ($registro) {
        return [
          'fechaAplicacion' => date('Y-m-d', strtotime($registro->fechaAplicacion)),
          'idContenidoTrat' => $registro->idContenidoTrat,
        ];
      }, json_decode($request->data));
      if(count($registros) > 0 && count($dataDelete) > 0){
        $resIns = DB::table('tblaplicaciontrat')->insert($registros);
        $resDelete = DB::table('tblaplicaciontrat')->whereIn('idAplicacionTrat', $dataDelete)->delete();
        if($resIns && $resDelete){
          echo json_encode(array('status'=>'success', 'message' => 'Operación realizada con éxito'));
        }else{
          echo json_encode(array('status'=>'error', 'message' => 'Error al realizar la operación'));
        }
      }elseif(count($dataDelete) > 0){
        $resDelete = DB::table('tblaplicaciontrat')->whereIn('idAplicacionTrat', $dataDelete)->delete();
        if($resDelete){
          echo json_encode(array('status'=>'success', 'message' => 'Operación realizada con éxito'));
        }else{
          echo json_encode(array('status'=>'error', 'message' => 'Error al realizar la operación [Eliminar]'));
        }
      }else{
        $resIns = DB::table('tblaplicaciontrat')->insert($registros);
        if($resIns){
          echo json_encode(array('status'=>'success', 'message' => 'Operación realizada con éxito'));
        }else{
          echo json_encode(array('status'=>'error', 'message' => 'Error al realizar la operación [Insertar]'));
        }
      }
    } catch (\Throwable $th) {
      echo json_encode(array('status'=>'error', 'message' => 'Error al realizar la operación: '.json_encode($th)));
    }
  }
}
