<?php

namespace App\Models;

use App\Models\Paciente\PacienteModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evolucion extends Model
{
    use HasFactory;

    protected $primaryKey = 'idEvolucion';
    protected $fillable = ['idPaciente', 'idEtapaActual'];
    protected $table = 'tblEvolucion';
    public $timestamps = false;

    public function tratamiento(){
        return $this->hasMany(Tratamiento::class, 'idEvolucion', 'idEvolucion');
    }
    public function tratamientoActual(){
        return Tratamiento::where('idEtapa', $this->idEtapaActual)->where('idEvolucion', $this->idEvolucion)->get()->first();
    }
    public function etapaActual(){
        return $this->hasOne(Etapa::class, 'idEtapa', 'idEtapaActual');
    }
    public function paciente(){
        return $this->belongsTo(PacienteModel::class, 'idPaciente');
    }
}
