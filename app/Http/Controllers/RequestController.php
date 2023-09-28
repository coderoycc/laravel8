<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico\MedicoModel;
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
}