<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class RequestController extends Controller
{

  public function medicoespecialidad($especialidad){
    $medicos = User::where('especialidad', $especialidad)->get();
    print_r($medicos);
    echo 'devuelto';
    // echo json_encode(array('status'=>'success', 'html'));
  }
}