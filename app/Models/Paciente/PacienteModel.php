<?php
namespace App\Models\Paciente;

use App\Models\Evolucion;
use App\Models\Historial\HistorialModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
  static public function getPacientesRegular(){
    return DB::select("SELECT th.idHistorial, th.idMedico, th.procedencia, th.etapa, th.fechaProxConsulta, tu.nombres, tu.apellidos, tu.idUsuario, tu.fechaNac FROM tblhistorial AS th 
    INNER JOIN tblusuario AS tu
    ON th.idPaciente = tu.idUsuario
    WHERE th.atendido LIKE 'SI';", []);
  }

  public function attributes(){
    return $this->attributes;
  }
  public function historialPaciente(){
    return $this->hasOne(HistorialModel::class, 'idPaciente');
  }
  public function tieneMedico(){
    return $this->hasOne(Historial::class, 'idMedico');
  }

  public function tieneEvolucion(){
    return $this->hasOne(Evolucion::class, 'idPaciente');
  }
}
?>