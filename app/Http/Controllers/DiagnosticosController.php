<?php

namespace App\Http\Controllers;

use App\Models\Diagnosticos;
use Illuminate\Http\Request;

class DiagnosticosController extends Controller
{

    public function index(){}

    public function create(){}

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
     * @param  \App\Models\Diagnosticos  $diagnosticos
     * @return \Illuminate\Http\Response
     */
    public function show(Diagnosticos $diagnosticos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diagnosticos  $diagnosticos
     * @return \Illuminate\Http\Response
     */
    public function edit(Diagnosticos $diagnosticos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diagnosticos  $diagnosticos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diagnosticos $diagnosticos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diagnosticos  $diagnosticos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnosticos $diagnosticos)
    {
        //
    }
}
