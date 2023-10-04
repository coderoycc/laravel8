<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etapa extends Model
{
    use HasFactory;
    protected $primaryKey = 'idEtapa';
    protected $fillable = ['idEtapa','detalle', 'etapaSiguiente'];
    protected $table = 'tblEtapa';
    public $timestamps = false;
}
