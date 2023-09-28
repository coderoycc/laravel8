<?php

namespace App\Models\Medico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicoModel extends Model
{
  use HasFactory;
  protected $table = 'tblUsuario';
  protected $fillable = ['nombres', 'apellidos', 'ci', 'fechaNac', 'genero', 'especialidad', 'celular', 'email', 'rol', 'password', 'matProfesional'];

  public function attributes()
  {
    return $this->attributes;
  }

  public function tienePacientes(){
    return $this->hasMany(Paciente::class, 'idUsuario');
  }
}