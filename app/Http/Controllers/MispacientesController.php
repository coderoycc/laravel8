<?php

namespace App\Http\Controllers;

use App\Models\Historial\HistorialModel;
use App\Models\Paciente\PacienteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MispacientesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');  
    }
    public function index(){
        $valores = PacienteModel::getPacientesRegular();
        return view('mispacientes.index', compact('valores'));
    }
    public function nuevos(){
        $user = Auth::user()->attributes();
        $idMedico = $user['idUsuario'];
        $historiales = HistorialModel::obtenerNuevos($idMedico);
        return view('mispacientes.nuevos', compact(array('historiales')));
    }
}
