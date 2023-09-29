<?php

namespace App\Http\Controllers;

use App\Models\Medico\MedicoModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Historial\HistorialModel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cantidadNuevos = 0;
        $misPacientes = 0;
        $cantidadMedicos = 0;
        $todosPacientes = 0;
        $user = Auth::user()->attributes();
        // echo $user['rol'] .'--'.$user['idUsuario'];
        if($user['rol'] == 'MEDICO'){
            $cantidadNuevos = HistorialModel::where('idMedico', $user['idUsuario'])->where('atendido','NO')->count();
            $misPacientes = HistorialModel::where('idMedico', $user['idUsuario'])->where('atendido', 'SI')->count();
        }elseif($user['rol'] == 'ADMIN'){
            $cantidadMedicos = MedicoModel::where('rol', 'MEDICO')->count();
            $todosPacientes = User::where('rol', 'PACIENTE')->count();
        }
        $variables = array('nuevos'=>$cantidadNuevos, 'misPacientes'=>$misPacientes, 'cantidadMedicos'=>$cantidadMedicos, 'todosPacientes' => $todosPacientes);
        
        return view('home', compact('variables'));
    }
}
