<?php

namespace App\Http\Controllers;

use App\Models\Historial\HistorialModel;
use App\Models\Medico\MedicoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class MispacientesController extends Controller
{
    public function index(){
        return view('mispacientes.index');
    }
    public function nuevos(){
        $user = Auth::user()->attributes();
        // $hist = User::where('rol', '=', 'PACIENTE')->join('tblHistorial as th', 'th.idPaciente', '=', 'tblUsuario.idUsuario')->where('th.idMedico', '=', $user['idUsuario'])->where('th.atendido', '=', 'NO')->select('th.*', 'tblUsuario.*')->get();
        // $historiales = DB::table('tblHistorial as th')
        //     ->join('tblUsuario as tu', 'th.idPaciente', '=', 'tu.idUsuario')
        //     ->where('th.idMedico', '=', 5)->where('th.atendido', '=', 'NO')
        //     ->select('th.*', 'tu.*')
        //     ->get();
        // $pacientes = $historiales->toArray();
        // print_r($hist->toArray());

        // $medico = Auth::user();
        $vals = HistorialModel::obtenerNuevos($user['idUsuario']);
        foreach($vals as $val){
            print_r($val->paciente);
            echo '<br><br>-------------------';
        }

        // print_r($vals);
        // $medico->
        // print_r($medico);
        // return view('mispacientes.nuevos', compact('pacientes'));
    }
}
