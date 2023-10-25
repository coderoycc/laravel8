<?php

namespace App\Http\Controllers;

use App\Models\Historial\HistorialModel;
use Illuminate\Http\Request;
use App\Models\Medico\MedicoModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller {

  public function medicoespecialidad($especialidad) {
    try {
      $cadHtml = '';
      if ($especialidad == 'EMERGENCIA') {
        $medicos = MedicoModel::where('rol', 'MEDICO')->get();
      } else {
        $medicos = MedicoModel::where('especialidad', $especialidad)->get();
      }
      foreach ($medicos as $medico) {
        $cadHtml .= '<option value="' . $medico->idUsuario . '">' . $medico->apellidos . ' ' . $medico->nombres . '</option>';
      }
      echo json_encode(array('status' => 'success', 'html' => $cadHtml));
    } catch (\Throwable $th) {
      echo json_encode(array('status' => 'error', 'html' => json_encode($th)));
    }
  }
  public function medicamento($cadena) {
    try {
      $cadHtml = '';
      $respuesta = DB::select("SELECT * FROM tblmedicamento WHERE descripcion LIKE '%$cadena%' LIMIT 0, 8");
      $cant = 0;
      foreach ($respuesta as $medicamento) {
        $cant++;
        $cadHtml .= '<li data-id="' . $medicamento->idMedicamento . '">' . $medicamento->descripcion . '</li>';
      }
      echo json_encode(array('status' => 'success', 'html' => $cadHtml, 'cant' => $cant));
    } catch (\Throwable $th) {
      echo json_encode(array('status' => 'error', 'html' => json_encode($th)));
    }
  }

  public function calendarpac(Request $request) {
    $idHistorial = $request->input('id');
    $historial =  HistorialModel::where('idHistorial', $idHistorial)->get()->first();
    try {
      $arr = [];
      // print_r($historial);
      if ($historial) {
        $resultado = DB::table('tblconsulta')
          ->select('fechaConsulta')
          ->where('idHistorial', $historial->idHistorial)
          ->orderBy('proxConsulta')
          ->get();
        $cont = 1;
        // print_r($resultado);
        foreach ($resultado as $fechaConsult) {
          $arr[] = ['title' => 'Consulta ' . $cont, 'start' => $fechaConsult->fechaConsulta, 'allDay' => true, 'color' => '#98cf31'];
          $cont++;
        }
        $arr[] = ['title' => 'Próxima consulta', 'start' => $historial->fechaProxConsulta, 'allDay' => true, 'color' => '#0f8d3e'];
      }
      echo json_encode($arr);
      // echo json_encode(array(['title'=>'Evento 1', 'start'=>'2023-10-10','allDay'=>true, 'color'=>'#98cf31', 'url'=>'https://google.com'],['title'=>'Evento 2', 'start'=>'2023-10-11','allDay'=>true, 'color'=>'#84ce22'], ['title'=>'Evento 5', 'start'=>'2023-10-08','allDay'=>true, 'color'=>'#0f8d3e'])); 
    } catch (\Exception $th) {
      echo json_encode([]);
    }
  }
  public function pacientesenSala(Request $request) {
    $idMedico = $request->input('uuid');
    $current = date('Y-m-d');
    $biometricoData = DB::select("
    SELECT tb.idBiometrico, tb.horaRegistro, tmp.* FROM biometrico tb 
    INNER JOIN ( SELECT idUsuario, apellidos, nombres, ci FROM tblusuario WHERE idUsuario IN (
        SELECT idPaciente FROM tblhistorial
        WHERE idMedico = " . $idMedico . "
      )
    ) tmp
    ON tb.ci = tmp.ci
    WHERE tb.horaRegistro > '" . $current . "'
    AND tb.estado LIKE 'NO ATENDIDO'
    ORDER BY tb.horaRegistro ASC;
    ");

    if (count($biometricoData) > 0) {
      $html = '';
      foreach ($biometricoData as $biometrico) {
        $html .= '<li class="mb-4">' . $biometrico->apellidos . ' ' . $biometrico->nombres . ' <button class="btn btn-success btn-sm float-right" onclick="atender(' . $biometrico->idBiometrico . ')"><i class="fas fa-check"></i></button><span class="float-right font-weight-bold mr-3">' . date('H:i', strtotime($biometrico->horaRegistro)) . '</span></li>';
      }
      echo json_encode(array('status' => 'success', 'html' => '<ul style="margin-left:-18px">' . $html . '</ul>'));
    } else {
      echo json_encode(array('status' => 'success', 'html' => '<ul style="margin-left:-18px"><li>No hay pacientes en la sala</li></ul>'));
    }
  }
  public function cambiarEstado(Request $request) {
    $idBiometrico = $request->all()['idBiometrico'];
    $res = DB::update("UPDATE biometrico SET estado = 'ATENDIDO' WHERE idBiometrico = " . $idBiometrico);
    if($res){
      echo json_encode(array("status"=> "success","message"=> "Paciente eliminado de la cola"));
    }else{
      echo json_encode(array("status"=> "error","message"=>"No se pudo eliminar de la cola al paciente"));
    }
  }
}
