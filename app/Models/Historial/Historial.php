<?php

namespace App\Models\Historial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;
    protected $table = 'tblhistorial';
    // para saber a que usuario pertenece este historial
    public function paciente(){
        return $this->belongsTo(User::class, 'idUsuario');
    }
    public function medico(){
        return $this->belongsTo(User::class, 'idMedico');
    }
    public function consultas(){
        return $this->hasMany(Consulta::class);
    }
}
