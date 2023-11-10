<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tratamiento extends Model
{
    use HasFactory;
    protected $primaryKey = 'idTratamiento';
    protected $fillable = ['idEtapa', 'idEvolucion'];
    protected $table = 'tblTratamiento';
    public $timestamps = false;

    public function contenido(){
        return $this->hasMany(ContenidoTrat::class,'idTratamiento','idTratamiento');
    }
    public function intratecales(){
        $intratecales = DB::table('tblintratecales')
        ->join('tblmedicamento', 'tblintratecales.idMedicamento', '=', 'tblmedicamento.idMedicamento')
        ->where('tblintratecales.idTratamiento', $this->idTratamiento)
        ->select('tblintratecales.dosis', 'tblmedicamento.descripcion')
        ->get();
        return $intratecales;
    }
    public function etapa(){
        return $this->hasOne(Etapa::class,'idEtapa','idEtapa');
    }
}
