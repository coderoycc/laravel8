<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Paciente\PacienteModel;
use App\Models\Historial\HistorialModel;
use Carbon\Carbon;

class Paciente extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index()
  {
    $pacientes = User::where('rol', 'PACIENTE')->get();
    return view('pacientes.index', compact('pacientes'));
  }

  public function create()
  {
    //consultar la base de datos para obtener a usuarios con rol medico
    $medicos = User::where('rol', 'MEDICO')->get();
    $arrMedic = [];
    foreach ($medicos as $medico) {
      $arrMedic[$medico->idUsuario] = $medico->apellidos . ' ' . $medico->nombres;
    }
    return view('pacientes.create', compact('arrMedic'));
  }

  public function store(Request $request)
  {
    try {
      $data = $request->all();
      $data['password'] = bcrypt($data['ci']); 
      $data['rol'] = 'PACIENTE';
      $paciente = PacienteModel::create($data);
      $idPaciente =$paciente->attributes()['idUsuario'];
  
      $dataHistorial = ['idPaciente'=>$idPaciente, 'idMedico'=>$data['idMedico'], 'fechaConsulta'=> $data['fechaConsulta'], 'procedencia'=>$data['procedencia'], 'servicio'=>$data['tipo'], 'etapa'=>''];

      HistorialModel::create($dataHistorial);
      $request->session()->flash('success', 'El paciente se ha registrado con éxito.');
      return redirect()->route('paciente.index');
    } catch (\Throwable $th) {
      // echo "Error: " . $th->getMessage() . " en línea " . $th->getLine();
      $request->session()->flash('error', 'Ocurrio un error al registrar al paciente. {'.json_encode($th).'}');
      return redirect()->route('paciente.index');
    }
  }

  public function medico()
  {
    return view('pacientes.medico');
  }

  public function nuevos(){
    return view('pacientes.nuevos');
  }

  public function evolucion()
  {
    return view('pacientes.evolucion');
  }

  public function show($id)
  {
    return view('pacientes.show');
  }

  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }

  public function ProtocolSTJudePDF(){
    $data = [
      'fecha' => Carbon::parse('2023-08-25'),
      'etapas' => [
        'induccion','consolidacion','continuacion 1','reinduccion 1','continuacion ii','reinduccion ii','mantenimiento'
      ],
    ];
    // Inicializando el Objeto creador de PDF
    $pdf = app('dompdf.wrapper');
    // Asignando la vista de referencia del documento
    $pdf->loadView('pacientes.protocol_report', compact('data'));
    // Configuracion las dimensiones del documento
    $pdf->setPaper('legal','landscape');
    // Definiendo el tipo de fuente
    $pdf->set_option('defaultFont', 'Helvetica');
    return $pdf->stream();
  }
}