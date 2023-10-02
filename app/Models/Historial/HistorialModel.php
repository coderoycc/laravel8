<?php

namespace App\Models\Historial;

use App\Models\Medico\MedicoModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Paciente\PacienteModel;
use Illuminate\Support\Facades\DB;

class HistorialModel extends Model
{
    use HasFactory;
    protected $table = 'tblhistorial';
    protected $primaryKey = 'idHistorial';
    protected $fillable = ['idPaciente', 'idMedico', 'fechaConsulta', 'servicio', 'procedencia','etapa', 'fechaProxConsulta'];

    static public function obtenerNuevos($idMedico){
        return HistorialModel::where('atendido','NO')->orderBy('fechaConsulta','asc')->where('idMedico',$idMedico)->get();
    }
    static public function getById($idHistorial){
        return HistorialModel::where('idHistorial',$idHistorial)->get();
    }
    static public function updateFechaProxConsulta($fecha, $idHistorial){
        return DB::update('UPDATE tblhistorial SET fechaProxConsulta = ? WHERE idHistorial = ?', [$fecha, $idHistorial]);
    }

    // para saber a que usuario pertenece este historial
    public function paciente(){
        return $this->belongsTo(PacienteModel::class, 'idPaciente');
    }
    public function medico(){
        return $this->belongsTo(MedicoModel::class, 'idMedico');
    }
    public function consultas(){
        return $this->hasMany(Consulta::class);
    }
}
