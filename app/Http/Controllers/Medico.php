<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Medico\MedicoModel;
use App\Providers\AuthServiceProvider;
use Illuminate\Support\Facades\Auth;

class Medico extends Controller {

  public function __construct() {
    $this->middleware('auth');
  }
  public function index() {
    $medicos = User::where('rol', 'MEDICO')->where('estado', 'ALTA')->get();
    return view('medico.index', compact('medicos'));
  }
  public function bajasList() {
    $medicos = MedicoModel::where('rol', 'MEDICO')->where('estado', 'BAJA')->get();
    return view('medico.bajalist', compact('medicos'));
  }


  public function create() {
    return view('medico.create');
  }
  public function darBaja(Request $request) {
    date_default_timezone_set('America/La_Paz');
    $now = date('Y-m-d');
    $medico = MedicoModel::where('idUsuario', $request->all()['idMedico'])->first();
    if ($medico) {
      $medico->estado = 'BAJA';
      $medico->fechaBaja = $now;
      if ($medico->save()) {
        return response()->json(['status' => 'success', 'message' => 'Médico dado de baja']);
      }
      return response()->json(['status' => 'error', 'message' => 'No se pudo dar de baja al médico']);
    } else {
      return response()->json(['status' => 'error', 'message' => 'No se encontró al médico para dar baja']);
    }
  }

  public function store(Request $request) {
    try {
      $data = $request->all();
      $data['password'] = bcrypt($data['ci']);
      $data['rol'] = 'MEDICO';
      MedicoModel::create($data);

      $request->session()->flash('success', 'El médico se ha registrado con éxito.');
      return redirect()->route('medico.index');
    } catch (\Throwable $th) {
      $request->session()->flash('error', 'Ocurrio un error al registrar al médico.');
      return redirect()->route('medico.index');
    }
  }

  public function show($id) {
    //
  }

  public function edit($id) {
    $medico = MedicoModel::where('idUsuario', $id)->first();
    return view('medico.edit', compact('medico'));
  }


  public function update(Request $request, MedicoModel $medico) {
    $data = $request->all();
    $medico->nombres = $data['nombres'];
    $medico->apellidos = $data['apellidos'];
    $medico->genero = $data['genero'];
    $medico->especialidad = $data['especialidad'];
    $medico->matProfesional = $data['matProfesional'];
    $medico->celular = $data['celular'];
    $medico->email = $data['email'];
    try {
      $medico->save();
      $request->session()->flash('success', 'El médico se ha modificado con éxito.');
      return redirect()->route('medico.index');
    } catch (\Throwable $th) {
      $request->session()->flash('error', 'Ocurrio un error al modificar al médico.');
      return redirect()->route('medico.index');
    }
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

  public function medicoespecialidad($especialidad) {
    $medicos = User::where('especialidad', $especialidad)->get();
    print_r($medicos);
    echo 'devuelto';
    // echo json_encode(array('status'=>'success', 'html'));
  }
}
