<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historial\HistorialModel as HistorialModel;
use App\Models\Diagnosticos;
use Illuminate\Support\Facades\DB;

class Historial extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index() // leer todos los registros
  {
    //
  }

  public function show(HistorialModel $historial) // visualizar un solo registro a detalle
  {
    print_r($historial);
  }

  public function edit(HistorialModel $historial) // mostrar para editar un registro
  {
    $diagnosticoscie = DB::select('SELECT * FROM tbldiagnosticocie');
    return view('historial.edit', compact(array('historial', 'diagnosticoscie')));
  }

  public function update(Request $request, HistorialModel $historial) // actualizar registro
  {
    try {
      $valores = $request->all();
      // $diagList = json_decode($valores['diagnosticos']);
      $historial->atendido = 'SI';
      $historial->tipoCancer = $valores['tipoCancer'];
      $historial->etapa = $valores['etapa'];
      $historial->valoracion = $valores['valoracion'];
      $historial->observacion = $valores['observacion'];
      $historial->fechaProxConsulta = $valores['fechaProxConsulta'];
      $peso = number_format($valores['peso'], 2);
      $historial->peso = $peso;
      $talla = number_format($valores['talla'], 2);
      $historial->talla = $talla;
      $historial->save();
      Diagnosticos::create(['idHistorial' => $historial->idHistorial, 'idDiagnosticoCIE' => $valores['diagnostico_cie']]);
      // foreach ($diagList as $diag) {
      //   $data = ['idHistorial' => $historial->idHistorial, 'idDiagnosticoCIE' => $diag];
      //   Diagnosticos::create($data);
      // }
      $request->session()->flash('success', 'Datos guardados con éxito');
      return redirect()->route('mispacientes.index');
    } catch (\Throwable $th) {
      $request->session()->flash('error', 'Ocurrio un error al registrar los datos {'.json_encode($th).'}.');
      return redirect()->route('mispacientes.index');
    }
  }
}