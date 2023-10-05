<?php

namespace App\Models;

use App\Models\Historial\HistorialModel;
use App\Models\Medico\MedicoModel;
use App\Models\Paciente\PacienteModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internacion extends Model
{
    use HasFactory;
    protected $table = 'tblInternacion';
    protected $primaryKey = 'idInternacion';
    public $timestamps = false;
    protected $fillable = ['idPaciente', 'idMedico', 'indicaciones', 'motivo'];

    static public function getSolicitudes(){
        return Internacion::where('estado', 'SOLICITUD')->orderBy('fechaSolicitud', 'ASC')->get();
    }
    static public function cantidadSolicitudes(){
        return Internacion::where('estado', 'SOLICITUD')->count();
    }

    public function paciente(){
        return $this->belongsTo(PacienteModel::class, 'idPaciente');
    }

    public function medico(){
        return $this->belongsTo(MedicoModel::class, 'idMedico');
    }
}
