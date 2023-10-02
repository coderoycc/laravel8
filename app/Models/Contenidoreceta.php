<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contenidoreceta extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tblcontenidoreceta';
    protected $primaryKey = 'idContenidoReceta';
    protected $fillable = ['idMedicamento', 'idReceta', 'unidad']; // unidad describe la cantidad y unidad

    public function medicamento(){
        return $this->belongsTo(Medicamento::class, 'idMedicamento');
    }
    public function receta(){
        return $this->belongsTo(Receta::class, 'idReceta');
    }

}
