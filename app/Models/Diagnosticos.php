<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Diagnosticos extends Model
{
    use HasFactory;
    protected $table = 'tblDiagnosticospaciente';
    protected $primaryKey = 'idDiagnosticoPaciente';

    public $timestamps = false;

    protected $fillable = ['idHistorial', 'idDiagnosticoCIE'];

    public function nombre(){
        return DB::select('SELECT * FROM tblDiagnosticocie WHERE codigo_cie = ?', [$this->idDiagnosticoCIE])[0];
    }
}
