<?php
namespace App\Models\Consulta;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Historial\HistorialModel;
use App\Models\Receta;

class Consulta extends Model
{
  use HasFactory;
  public $timestamps = false;
  protected $table = 'tblconsulta';
  protected $primaryKey = 'idConsulta';
  protected $fillable = ['idHistorial', 'valoracion', 'observaciones', 'peso', 'talla', 'proxConsulta'];

  // Para saber a que historial pertenece
  public function historial(){
    return $this->belongsTo(HistorialModel::class, 'idHistorial');
  }

  public function receta(){
    return $this->hasOne(Receta::class, 'idConsulta');
  }
}

?>
