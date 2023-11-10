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
      $dataHistorial = ['idPaciente' => $idPaciente, 'idMedico' => $data['idMedico'], 'fechaConsulta' => $data['fechaConsulta'], 'procedencia' => $data['procedencia'], 'servicio' => $data['tipo'], 'etapa' => '', 'fechaProxConsulta' => $data['fechaConsulta']];

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
      $idHistorial = HistorialModel::where('idPaciente', $user->idUsuario)->first()->idHistorial;
      if($idHistorial){
        return view('pacientes.calendar',compact('idHistorial'));
      }
      return redirect()->route('home');
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
    $utils = ["1"=>["#17a2b8","fa-file-medical-alt"], "2"=>["#6c757d","fa-file-medical"], 
            "3"=>["#fd7e14","fa-notes-medical"], "4" => ["#007bff", "fa-hand-holding-medical"], 
            "5"=>["#20c997", "fa-prescription-bottle-alt"], 
            "6"=>["#28a745", "fa-pump-medical"], "7"=>["#6f42c1", "fa-heartbeat"]];
    $etapas = DB::table('tbletapa as te')
    ->select('te.detalle', 'te.idEtapa', 'tt.idTratamiento', 'tt.fechaInicio')
    ->leftJoin(
        DB::raw('(SELECT idTratamiento, fechaInicio, idEtapa FROM tbltratamiento WHERE idEvolucion = '.$evolucion->idEvolucion.') as tt'),
        'te.idEtapa',
        '=',
        'tt.idEtapa'
    )
    ->orderBy('te.idEtapa')
    ->get();
    return view('pacientes.evolucion', compact('idPaciente', 'etapas', 'utils'));
  }

  public function show($id) {
    return view('pacientes.show');
  }

  public function edit($id) {
    $paciente = PacienteModel::where('idUsuario', $id)->first();
    return view('pacientes.edit', compact('paciente'));
  }


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
    $tallaPeso = DB::select('SELECT th.peso pesoth, th.talla tallath, tc.peso, tc.talla FROM tblhistorial th
    LEFT JOIN tblconsulta tc
    ON th.idHistorial = tc.idHistorial
    WHERE th.idPaciente = ?
    ORDER BY tc.fechaConsulta DESC
    LIMIT 1', [$idPaciente]);
    $peso = $tallaPeso[0]->peso ? $tallaPeso[0]->peso : $tallaPeso[0]->pesoth;
    $talla = $tallaPeso[0]->talla ? $tallaPeso[0]->talla : $tallaPeso[0]->tallath;
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
    $pdf->loadView('pacientes.protocol_report', compact(array('data', 'evolucion', 'historial', 'arrFechas', 'tratamientoActual', 'peso', 'talla')));
    // Configuracion las dimensiones del documento
    $pdf->setPaper('legal', 'landscape');
    // Definiendo el tipo de fuente
    $pdf->set_option('defaultFont', 'Helvetica');
    return $pdf->stream();
  }

  public function ProtocolSTJudeTrat($idPaciente, $idTratamiento){
    $evolucion = Evolucion::where('idPaciente', $idPaciente)->first();
    $historial = HistorialModel::where('idPaciente', $idPaciente)->first();
    $etapas = Etapa::all();
    $tratamientoActual = Tratamiento::find($idTratamiento);
    $data = [
      'fecha' => Carbon::parse($tratamientoActual->fechaInicio), // tendria que ir la fecha inicio de la etapa
      'etapas' => $etapas->pluck('detalle')->all(),
    ];
    $tallaPeso = DB::select('SELECT th.peso pesoth, th.talla tallath, tc.peso, tc.talla FROM tblhistorial th
    LEFT JOIN tblconsulta tc
    ON th.idHistorial = tc.idHistorial
    WHERE th.idPaciente = ?
    ORDER BY tc.fechaConsulta DESC
    LIMIT 1', [$idPaciente]);
    $peso = $tallaPeso[0]->peso ? $tallaPeso[0]->peso : $tallaPeso[0]->pesoth;
    $talla = $tallaPeso[0]->talla ? $tallaPeso[0]->talla : $tallaPeso[0]->tallath;
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
    $pdf->loadView('pacientes.protocol_report', compact(array('data', 'evolucion', 'historial', 'arrFechas', 'tratamientoActual','peso', 'talla')));
    // Configuracion las dimensiones del documento
    $pdf->setPaper('legal', 'landscape');
    // Definiendo el tipo de fuente
    $pdf->set_option('defaultFont', 'Helvetica');
    return $pdf->stream();
  }
}
