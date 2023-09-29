<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Medico\MedicoModel; 
use App\Providers\AuthServiceProvider;
use Illuminate\Support\Facades\Auth;

class Medico extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index()
  {
    // $gate = app()->make('Gate');
    // if ($gate->authorize('admin')) {
    // } else {
    //   abort(403); // Mostrar una página de error 403 Forbidden
    // }
    $medicos = User::where('rol', 'MEDICO')->get();
    return view('medico.index', compact('medicos'));
  }


  public function create()
  {
    return view('medico.create');
  }


  public function store(Request $request)
  {
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

  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
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

  public function medicoespecialidad($especialidad){
    $medicos = User::where('especialidad', $especialidad)->get();
    print_r($medicos);
    echo 'devuelto';
    // echo json_encode(array('status'=>'success', 'html'));
  }
}