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
  public function solicitud(){
    $solicitudes = Internacion::where('estado', 'SOLICITUD')->get();
    return view('internacion.solicitudes', compact('solicitudes'));
  }
  public function index(){
    $internaciones = Internacion::where('estado', '!=','SOLICITUD')->get();
    return view('internacion.index', compact('internaciones'));
  }
  public function data($idInternacion){
    try {
      $internacion = Internacion::find($idInternacion);
      if($internacion){
        $data = array(
          'motivo'=>$internacion->motivo, 
          'indicaciones'=>$internacion->indicaciones, 
          'paciente'=>$internacion->paciente->nombres.' '.$internacion->paciente->apellidos,
          'medico'=>$internacion->medico->nombres.' '.$internacion->medico->apellidos,
          'historial'=>$internacion->paciente->historialPaciente,
        );
        echo json_encode(array('status'=>'success', 'data'=>$data));
      }else{
        echo json_encode(array('status'=>'error', 'message'=>'No existe internacion con id '.$idInternacion));
      }
    } catch (\Throwable $th) {
      echo json_encode(array('status'=>'error', 'message'=>$th->getMessage()));
    }
  }

  public function update(Request $request){
    try {
      $data = $request->all();
      $internacion = Internacion::find($data['idInternacion']);
      if($internacion){
        $internacion->estado = 'REVISADO';
        // $internacion->cama = $data['cama'];
        $internacion->save();
        echo json_encode(array('status'=>'success', 'message'=>'Internacion revisada con éxito'));
      }else{
        echo json_encode(array('status'=>'error', 'message'=>'No existe internacion con id '.$data['idInternacion']));
      }
    } catch (\Throwable $th) {
      echo json_encode(array('status'=>'error', 'message'=>$th->getMessage()));
    }
  }
  public function formulario($idInternacion){
    $internacion = Internacion::find($idInternacion);
    $pdf = app('dompdf.wrapper');
    $pdf->loadView('internacion.formulario', compact('internacion'));
    $pdf->setPaper('letter','portrail'); //396x612
    $pdf->set_option('defaultFont', 'Helvetica');
    return $pdf->stream();
  }
}
