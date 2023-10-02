<?php

namespace App\Http\Controllers;

use App\Models\Consulta\Consulta;
use App\Models\Contenidoreceta;
use Illuminate\Http\Request;
use App\Models\Historial\HistorialModel;
use App\Models\Receta;

class ConsultaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  public function create($idHistorial)
  {
    $historial = HistorialModel::getById($idHistorial);
    $historial = $historial->first();
    return view('consulta.create', compact('historial'));
  }

  public function store(Request $request)
  {
    try {
      $datos = $request->all();
      $consulta = Consulta::create([
        'idHistorial' => $datos['idHistorial'],
        'valoracion' => $datos['valoracion'],
        'observaciones' => $datos['observacion'],
        'peso' => $datos['peso'],
        'talla' => $datos['talla'],
        'proxConsulta' => $datos['fechaProxConsulta']
      ]);
      HistorialModel::updateFechaProxConsulta($datos['fechaProxConsulta'], $datos['idHistorial']);
      $idMedicamentos = json_decode($datos['idsMedicamento']);
      $dosificacion = json_decode($datos['valoresDosis']);
      $n = count($idMedicamentos);
      $idReceta = 0;
      if($n > 0){
        $receta = Receta::create([
          'idConsulta' => $consulta->idConsulta,
          'diagnostico' => $datos['valoracion']
        ]);
        $idReceta = $receta->idReceta;
        for ($i = 0; $i < $n; $i++) { 
          Contenidoreceta::create([
            'idReceta' => $idReceta,
            'idMedicamento' => $idMedicamentos[$i],
            'unidad' => $dosificacion[$i]
          ]);
        }
      }
      echo json_encode(array('status'=>'success', 'message'=>'Consulta registrada', 'idReceta'=>$idReceta));
    } catch (\Throwable $th) {
      echo json_encode(array('status'=>'error', 'message'=>json_encode($th)));
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Consulta  $consulta
   * @return \Illuminate\Http\Response
   */
  public function show(Consulta $consulta)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Consulta  $consulta
   * @return \Illuminate\Http\Response
   */
  public function edit(Consulta $consulta)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Consulta  $consulta
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Consulta $consulta)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Consulta  $consulta
   * @return \Illuminate\Http\Response
   */
  public function destroy(Consulta $consulta)
  {
    //
  }
}