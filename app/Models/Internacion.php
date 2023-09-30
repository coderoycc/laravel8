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
    protected $fillable = ['idPaciente', 'indicaciones', 'motivo', 'fechaSolicitud'];
}
