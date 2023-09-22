<?php

namespace App\Models\Historial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialModel extends Model
{
    use HasFactory;
    public function usuario()
    {
        return $this->belongsTo(\App\Models\User::class, 'idUsuario');
    }
}
