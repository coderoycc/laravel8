<?php

namespace App\Models\Medico;

use App\Http\Controllers\Historial;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicoModel extends Model
{
  use HasFactory;
  protected $table = 'tblUsuario';
  protected $primaryKey = 'idUsuario';
  protected $fillable = ['nombres', 'apellidos', 'ci', 'fechaNac', 'genero', 'especialidad', 'celular', 'email', 'rol', 'password', 'matProfesional'];

  public function attributes()
  {
    return $this->attributes;
  }

  public function tienePacientes(){
    return $this->hasMany(Historial::class, 'idMedico');
  }
}