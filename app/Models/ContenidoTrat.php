<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContenidoTrat extends Model
{
    use HasFactory;
    protected $primaryKey = 'idContenidoTrat';
    protected $fillable = ['idTratamiento', 'idMedicamento', 'dosis'];
    protected $table = 'tblContenidoTrat';
    public $timestamps = false;


}
