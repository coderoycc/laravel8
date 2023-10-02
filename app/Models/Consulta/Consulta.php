<?php
namespace App\Models\Consulta;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
  use HasFactory;
  public $timestamps = false;
  protected $table = 'tblconsulta';
  protected $primaryKey = 'idConsulta';
  protected $fillable = ['idHistorial', 'valoracion', 'observaciones', 'peso', 'talla', 'proxConsulta'];

  // Para saber a que historial pertenece
  public function historial(){
    return $this->belongsTo(Historial::class);
  }
}

?>
