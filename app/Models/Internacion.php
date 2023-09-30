<?php

namespace App\Models;

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
}
