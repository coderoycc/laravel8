<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Paciente\PacienteModel;
use App\Models\Historial\HistorialModel;
use PhpParser\Node\Stmt\TryCatch;

class Paciente extends Controller
{
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
      $idPaciente =$paciente->attributes()['id'];
  
      $dataHistorial = ['idUsuario'=>$idPaciente, 'idMedico'=>$data['idMedico']];
      HistorialModel::create($dataHistorial);
      $request->session()->flash('success', 'El paciente se ha registrado con éxito.');
      return redirect()->route('paciente.index');
    } catch (\Throwable $th) {
      $request->session()->flash('error', 'Ocurrio un error al registrar al paciente.');
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
}