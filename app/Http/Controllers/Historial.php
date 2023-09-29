<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historial\HistorialModel as HistorialModel;
class Historial extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // leer todos los registros
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() // nuevo historial
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  HistorialModel $historial
     * @return \Illuminate\Http\Response
     */
    public function show(HistorialModel $historial) // visualizar un solo registro a detalle
    {
        print_r($historial);
    }

    public function edit(HistorialModel $historial) // mostrar para editar un registro
    {
        return view('historial.edit', compact('historial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  HistorialModel $historial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistorialModel $historial) // actualizar registro
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param HistorialModel $historial
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistorialModel $historial) // eliminar un registro
    {
        //
    }
}
