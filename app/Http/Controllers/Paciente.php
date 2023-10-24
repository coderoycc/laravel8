<?php

namespace App\Http\Controllers;

use App\Models\Etapa;
use App\Models\Evolucion;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Paciente\PacienteModel;
use App\Models\Historial\HistorialModel;
use App\Models\Tratamiento;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Paciente extends Controller {
  public function __construct() {
    $this->middleware('auth');
  }
  public function index() {
    $pacientes = User::where('rol', 'PACIENTE')->get();
    return view('pacientes.index', compact('pacientes'));
  }

  public function create() {
    //consultar la base de datos para obtener a usuarios con rol medico
    $medicos = User::where('rol', 'MEDICO')->get();
    $arrMedic = [];
    foreach ($medicos as $medico) {
      $arrMedic[$medico->idUsuario] = $medico->apellidos . ' ' . $medico->nombres;
    }
    return view('pacientes.create', compact('arrMedic'));
  }

  public function store(Request $request) {
    try {
      $data = $request->all();
      $data['password'] = bcrypt($data['ci']);
      $data['rol'] = 'PACIENTE';
      $paciente = PacienteModel::create($data);
      // $idPaciente =$paciente->attributes()['idUsuario'];
      $idPaciente = $paciente->idUsuario;
      $dataHistorial = ['idPaciente' => $idPaciente, 'idMedico' => $data['idMedico'], 'fechaConsulta' => $data['fechaConsulta'], 'procedencia' => $data['procedencia'], 'servicio' => $data['tipo'], 'etapa' => ''];

      $historial = HistorialModel::create($dataHistorial);
      // Se deberia crear el registro para la evolucion con etapa actual 1
      $evolucion = Evolucion::create(['idPaciente' => $idPaciente, 'idEtapaActual' => 1]);
      $tratamiento = Tratamiento::create(['idEvolucion' => $evolucion->idEvolucion, 'idEtapa' => 1]);
      $request->session()->flash('success', 'El paciente se ha registrado con éxito.');
      return redirect()->route('paciente.index');
    } catch (\Throwable $th) {
      // echo "Error: " . $th->getMessage() . " en línea " . $th->getLine();
      $request->session()->flash('error', 'Ocurrio un error al registrar al paciente. {' . json_encode($th) . '}');
      return redirect()->route('paciente.index');
    }
  }
  public function calendar() {
    $user = Auth::user();
    if ($user->rol == 'PACIENTE') {
      return view('pacientes.calendar');
    } else {
      return redirect()->route('home');
    }
  }
  public function medico() {
    return view('pacientes.medico');
  }

  public function nuevos() {
    return view('pacientes.nuevos');
  }

  public function evolucion() {

    // /report/{idPaciente}/show
    $idPaciente = Auth::user()->idUsuario;
    $evolucion = Evolucion::where('idPaciente', $idPaciente)->get()->first();
    $tratamientos = $evolucion->tratamiento;
    return view('pacientes.evolucion', compact('tratamientos'));
  }

  public function show($id) {
    return view('pacientes.show');
  }

  public function edit($id) {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    //
  }

  public function ProtocolSTJudePDF($idPaciente) {
    $evolucion = Evolucion::where('idPaciente', $idPaciente)->first();
    $historial = HistorialModel::where('idPaciente', $idPaciente)->first();
    $etapas = Etapa::all();
    $tratamientoActual = $evolucion->tratamientoActual();
    $data = [
      'fecha' => Carbon::parse($tratamientoActual->fechaInicio), // tendria que ir la fecha inicio de la etapa
      'etapas' => $etapas->pluck('detalle')->all(),
    ];
    $arrFechas = [];
    $fechaInicio = strtotime($tratamientoActual->fechaInicio);
    $arrFechas[] = date('d-m-Y', $fechaInicio);
    $fechaActual = strtotime($tratamientoActual->fechaInicio);
    $fechaFinal = strtotime($tratamientoActual->fechaInicio.'+20 days');
    for($i = 1; $i < 21; $i++){
      if($fechaActual < $fechaFinal){
        $fechaActual = strtotime(date('d-m-Y',$fechaActual).'+1 days');
        $arrFechas[] = date('d-m-Y', strtotime(date('d-m-Y',$fechaInicio)."+$i days"));
      } else {
        break;
      } 
    }
    // Inicializando el Objeto creador de PDF
    $pdf = app('dompdf.wrapper');
    // Asignando la vista de referencia del documento
    $pdf->loadView('pacientes.protocol_report', compact(array('data', 'evolucion', 'historial', 'arrFechas', 'tratamientoActual')));
    // Configuracion las dimensiones del documento
    $pdf->setPaper('legal', 'landscape');
    // Definiendo el tipo de fuente
    $pdf->set_option('defaultFont', 'Helvetica');
    return $pdf->stream();
  }
}
