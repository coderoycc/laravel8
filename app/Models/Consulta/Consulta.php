<?php
namespace App\Models\Consulta;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
  use HasFactory;
  protected $table = 'tblconsulta';

  // Para saber a que historial pertenece
  public function historial(){
    return $this->belongsTo(Historial::class);
  }
}

?>
