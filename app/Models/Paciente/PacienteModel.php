<?php
namespace App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PacienteModel extends Model{
  use HasFactory;
  protected $table = 'tblUsuario';
  protected $primaryKey = 'idUsuario';
  protected $fillable=['nombres', 'apellidos', 'ci', 'fechaNac', 'genero', 'codPaciente', 'celular', 'email', 'rol', 'password', 'codSus'];
  public function edad($fechaNac){
    date_default_timezone_set("America/La_Paz");
    $f_fin = date_create(date('Y-m-d'));
    $res = date_diff(date_create($fechaNac), $f_fin);
    return $res->format("%y años %m meses %d dias");
  }
  public function attributes(){
    return $this->attributes;
  }
  public function historialPaciente(){
    return $this->hasOne(Historial::class, 'idPaciente');
  }
  public function tieneMedico(){
    return $this->hasOne(Historial::class, 'idMedico');
  }
}
?>