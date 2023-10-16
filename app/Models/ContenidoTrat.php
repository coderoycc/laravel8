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
}
