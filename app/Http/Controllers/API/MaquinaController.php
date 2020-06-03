<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MaquinaResource;
use App\Http\Resources\MaquinaResourceCollection;
use Illuminate\Http\Request;
use App\Maquina;

class MaquinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): MaquinaResourceCollection 
    {
        return new MaquinaResourceCollection(Maquina::paginate());
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

    public function showMaquina(Request $request){
        //return Maquina::getIdMaquina($maquina->id);
        $code = $request->path();
        $code = explode("/",$code);
        return Maquina::getIdMaquina($code[2]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Maquina  $maquina
     * @return MaquinaResource
     */
    public function show(Maquina $maquina): MaquinaResource
    {
        return new MaquinaResource($maquina);
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
