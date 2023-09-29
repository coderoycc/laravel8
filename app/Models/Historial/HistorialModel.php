<?php

namespace App\Models\Historial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Paciente\PacienteModel;
class HistorialModel extends Model
{
    use HasFactory;
    protected $table = 'tblhistorial';
    protected $fillable = ['idPaciente', 'idMedico', 'fechaConsulta', 'servicio', 'procedencia','etapa'];

    static public function obtenerNuevos($idMedico){
        return HistorialModel::where('atendido','NO')->where('idMedico',$idMedico)->get();
    }



    // para saber a que usuario pertenece este historial
    public function paciente(){
        return $this->belongsTo(PacienteModel::class, 'idPaciente');
    }
    public function medico(){
        return $this->belongsTo(User::class, 'idMedico');
    }
    public function consultas(){
        return $this->hasMany(Consulta::class);
    }
}
