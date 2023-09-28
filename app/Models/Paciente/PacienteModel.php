<?php
namespace App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PacienteModel extends Model{
  use HasFactory;
  protected $table = 'tblUsuario';
  protected $fillable=['nombres', 'apellidos', 'ci', 'fechaNac', 'genero', 'codPaciente', 'celular', 'email', 'rol', 'password', 'codSus'];

  public function attributes(){
    return $this->attributes;
  }
  public function historialPaciente(){
    return $this->hasOne(Historial::class, 'idUsuario');
  }
  public function tieneMedico(){
    return $this->hasOne(Historial::class, 'idMedico');
  }
}
?>