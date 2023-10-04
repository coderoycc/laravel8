<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    use HasFactory;
    protected $primaryKey = 'idTratamiento';
    protected $fillable = [];
    protected $table = 'tblTratamiento';
    public $timestamps = false;

    public function contenidoMedicamento(){
        
    }
}
