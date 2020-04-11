<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Maquina;

class ImagenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Maquina $maquina
     * @return \Illuminate\Http\Response
     */
    public function index(Maquina $maquina)
    {
        return view('galerias.edit', compact('maquina'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Maquina $maquina
     * @return \Illuminate\Http\Response
     */
    public function create(Maquina $maquina)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Maquina $maquina
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  \App\Maquina $maquina
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  \App\Maquina $maquina
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  \App\Maquina $maquina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  \App\Maquina $maquina
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
