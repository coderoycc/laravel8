<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historial\HistorialModel as HistorialModel;
use App\Models\Diagnosticos;

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
    return view('historial.edit', compact('historial'));
  }

  public function update(Request $request, HistorialModel $historial) // actualizar registro
  {
    // try {
      $valores = $request->all();
      $diagList = json_decode($valores['diagnosticos']);
      $historial->atendido = 'SI';
      $historial->tipoCancer = $valores['tipoCancer'];
      $historial->etapa = $valores['etapa'];
      $historial->valoracion = $valores['valoracion'];
      $historial->observacion = $valores['observacion'];
      $peso = number_format($valores['peso'], 2);
      $historial->peso = $peso;
      $talla = number_format($valores['talla'], 2);
      $historial->talla = $talla;
      $historial->save();
      foreach ($diagList as $diag) {
        echo $diag;
        $data = ['idHistorial' => $historial->idHistorial, 'idDiagnosticoCIE' => $diag]; 
        Diagnosticos::create($data);
      }
      // Cannot add or update a child row: a foreign key constraint fails (`hospital`.`tbldiagnosticospaciente`, CONSTRAINT `tbldiagnosticospaciente_iddiagnosticocie_foreign` FOREIGN KEY (`idDiagnosticoCIE`) REFERENCES `tbldiagnosticocie` (`codigo_cie`))
    // } catch (\Throwable $th) {
    //   echo json_encode($th);
    //   // print_r($th);
    // }
  }
}