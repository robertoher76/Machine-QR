<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\InstruccioneResource;
use App\Http\Resources\InstruccioneResourceCollection;
use Illuminate\Http\Request;
use App\Instruccione;
use App\Instrucciones_tipo;
use App\Maquina;

class InstruccioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): InstruccioneResourceCollection 
    {
        return new InstruccioneResourceCollection(Instruccione::paginate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

    public function showInstruccione(Maquina $maquina,Request $request){
        $code = $request->path();
        $code = explode("/",$code);
        return Instruccione::getIntruccionesId($maquina->id,$code[3]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Instruccione  $Instruccione
     * @return InstruccioneResource
     */
    public function show(Instruccione $Instruccione): InstruccioneResource
    {
        return new InstruccioneResource($Instruccione);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
