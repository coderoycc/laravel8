<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ContenidoTrat extends Model {
  use HasFactory;
  protected $primaryKey = 'idContenidoTrat';
  protected $fillable = ['idTratamiento', 'idMedicamento', 'dosis'];
  protected $table = 'tblContenidoTrat';
  public $timestamps = false;

  public function medicamento() {
    return $this->belongsTo(Medicamento::class, 'idMedicamento');
  }

  /**
   * Verifica si se marco la aplicacion del medicamento
   * Retorna true o false
   * @fecha string: del tipo 'd-m-Y'
   * @return bool
   */
  public function aplicacion($fecha) {
    $fecha = date('Y-m-d', strtotime($fecha));
    return DB::table('tblAplicacionTrat')
      ->where('fechaAplicacion', $fecha)
      ->where('idContenidoTrat', $this->idContenidoTrat)
      ->exists();
  }

  /**
   * Genera las aplicaciones en el rango de fechas
   */
  public function aplicado($arrFecha){
    $ini = date('Y-m-d', strtotime($arrFecha[0]));
    $fin = date('Y-m-d', strtotime(end($arrFecha)));

    $aplicaciones = DB::table('tbltratamiento')
    ->join('tblcontenidotrat', 'tbltratamiento.idTratamiento', '=', 'tblcontenidotrat.idTratamiento')
    ->leftJoin('tblaplicaciontrat', 'tblaplicaciontrat.idContenidoTrat', '=', 'tblcontenidotrat.idContenidoTrat')
    ->where('tblcontenidotrat.idContenidoTrat', $this->idContenidoTrat)
    ->whereBetween('fechaAplicacion', [$ini, $fin])
    ->select('tblaplicaciontrat.idAplicacionTrat', 'tblcontenidotrat.idMedicamento', 'tblaplicaciontrat.fechaAplicacion')
    ->get();
    $salida = array();
    foreach ($aplicaciones as $aplicacion) {
      $fecha = date('d-m-Y', strtotime($aplicacion->fechaAplicacion));
      $i = array_search($fecha, $arrFecha);
      if($i !== false){
        $salida[$arrFecha[$i]] = $aplicacion->idAplicacionTrat;
      }
    }
    $resp = array();
    foreach ($arrFecha as $fecha) {
      if(!isset($salida[$fecha])){
        $salida[$fecha] = 0;
      }
      $resp[$fecha] = $salida[$fecha];
    }
    return $resp;
  }
}
