<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Consulta\Consulta;

class Receta extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tblreceta';
    protected $primaryKey = 'idReceta';
    protected $fillable = ['idConsulta', 'diagnostico'];

    public function consulta(){
        return $this->belongsTo(Consulta::class, 'idConsulta');
    }
    public function contenido(){
        return $this->hasMany(ContenidoReceta::class, 'idReceta');
    }
}
