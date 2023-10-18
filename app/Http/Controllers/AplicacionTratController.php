<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AplicacionTratController extends Controller {
  public function insertDeleteApTrat(Request $request){
    print_r(json_decode($request->data));
  }
}
