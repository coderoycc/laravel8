<?php

namespace App\Http\Controllers;

use App\Models\Historial\HistorialModel;
use Illuminate\Http\Request;
use App\Models\Medico\MedicoModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{

  public function medicoespecialidad($especialidad){
    try {
      $cadHtml = '';
      if($especialidad == 'EMERGENCIA'){
        $medicos = MedicoModel::where('rol', 'MEDICO')->get();
      }else{
        $medicos = MedicoModel::where('especialidad', $especialidad)->get();
      }
      foreach ($medicos as $medico) {
        $cadHtml .= '<option value="'.$medico->idUsuario.'">'.$medico->apellidos.' '.$medico->nombres.'</option>';
      }
      echo json_encode(array('status'=>'success', 'html'=>$cadHtml));
    } catch (\Throwable $th) {
      echo json_encode(array('status'=>'error', 'html'=>json_encode($th)));
    } 
  }
  public function medicamento($cadena){
    try {
      $cadHtml = '';
      $respuesta = DB::select("SELECT * FROM tblmedicamento WHERE descripcion LIKE '%$cadena%' LIMIT 0, 8");
      $cant = 0;
      foreach ($respuesta as $medicamento) {
        $cant++;
        $cadHtml .= '<li data-id="'.$medicamento->idMedicamento.'">'.$medicamento->descripcion.'</li>';
      }
      echo json_encode(array('status'=>'success', 'html'=>$cadHtml, 'cant'=>$cant));
    } catch (\Throwable $th) {
      echo json_encode(array('status'=>'error', 'html'=>json_encode($th)));
    }
  }

  public function calendarpac(Request $request){
    $idHistorial = $request->input('id');
    $historial =  HistorialModel::where('idHistorial', $idHistorial)->get()->first();
    try{
      $arr = [];
      // print_r($historial);
      if($historial){
        $resultado = DB::table('tblconsulta')
          ->select('fechaConsulta')
          ->where('idHistorial', $historial->idHistorial)
          ->orderBy('proxConsulta')
          ->get();
          $cont = 1;
        // print_r($resultado);
        foreach ($resultado as $fechaConsult) {
          $arr[] = ['title'=>'Consulta '.$cont, 'start'=>$fechaConsult->fechaConsulta,'allDay'=>true, 'color'=>'#98cf31'];
          $cont++;
        }
        $arr[] = ['title' => 'Próxima consulta', 'start' => $historial->fechaProxConsulta, 'allDay'=>true, 'color' => '#0f8d3e'];
      }
      echo json_encode($arr);
      // echo json_encode(array(['title'=>'Evento 1', 'start'=>'2023-10-10','allDay'=>true, 'color'=>'#98cf31', 'url'=>'https://google.com'],['title'=>'Evento 2', 'start'=>'2023-10-11','allDay'=>true, 'color'=>'#84ce22'], ['title'=>'Evento 5', 'start'=>'2023-10-08','allDay'=>true, 'color'=>'#0f8d3e'])); 
    }catch(\Exception $th){
      echo json_encode([]);
    }
  }
}