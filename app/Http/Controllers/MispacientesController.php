<?php

namespace App\Http\Controllers;

use App\Models\Historial\HistorialModel;
use App\Models\Medico\MedicoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MispacientesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');  
    }
    public function index(){
        return view('mispacientes.index');
    }
    public function nuevos(){
        $user = Auth::user()->attributes();
        $historiales = HistorialModel::obtenerNuevos($user['idUsuario']);
        return view('mispacientes.nuevos', compact('historiales'));
    }
}
