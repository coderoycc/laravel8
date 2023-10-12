<?php

namespace App\Http\Controllers;

use App\Models\Medico\MedicoModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Historial\HistorialModel;
use App\Models\Internacion;
use Illuminate\Support\Facades\Hash;

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
        $cantSolicitudesInterna = 0;
        $user = Auth::user();
        // echo $user['rol'] .'--'.$user['idUsuario'];
        if($user->rol == 'MEDICO'){
            $cantidadNuevos = HistorialModel::where('idMedico', $user->idUsuario)->where('atendido','NO')->count();
            $misPacientes = HistorialModel::where('idMedico', $user->idUsuario)->where('atendido', 'SI')->count();
        }elseif($user->rol == 'ADMIN'){
            $cantidadMedicos = MedicoModel::where('rol', 'MEDICO')->count();
            $todosPacientes = User::where('rol', 'PACIENTE')->count();
            $cantSolicitudesInterna = Internacion::cantidadSolicitudes();
        }
        $variables = array('nuevos'=>$cantidadNuevos, 'misPacientes'=>$misPacientes, 'cantidadMedicos'=>$cantidadMedicos, 'todosPacientes' => $todosPacientes, 'solicitudesInternacion' => $cantSolicitudesInterna);
        
        return view('home', compact('variables'));
    }

    public function cambiarPassword(Request $request)
    {
        try {
            $usuario = User::where('idUsuario', Auth::user()->idUsuario)->first();
            if(Hash::check($request->anterior, $usuario->password)){
                $usuario->password = bcrypt($request->nuevo);
                $usuario->save();
                echo json_encode(array('status'=>'success', 'message'=>'Actualizó su contraseña exitosamente'));
            }else{
                echo json_encode(array('status'=>'error', 'message'=>'Su contraseña anterior es incorrecta'));
            }
        } catch (\Throwable $th) {
            echo json_encode(array('status'=>'error', 'message'=>'Ocurrió algo inesperado '.json_encode($th)));
        }
    }

    public function resetearPassword(Request $request){
        try {
            $usuario = User::where('idUsuario', $request->idUsuario)->first();
            if($usuario){
                $usuario->password = bcrypt($usuario->ci);
                $usuario->save();
                echo json_encode(array('status'=>'success', 'message'=>'Se restableció la contraseña exitosamente'));
            }else{
                echo json_encode(array('status'=>'error', 'message'=>'No se encontró el usuario'));
            }
        }catch (\Throwable $th) {
            echo json_encode(array('status'=>'error', 'message'=>'Ocurrió algo inesperado '.json_encode($th)));
        }
    }

    
}
