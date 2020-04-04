<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInstruccionRequest;
use App\Http\Requests\EditInstruccionRequest;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use App\Instrucciones_tipo;
use App\Procedimiento;
use App\Instruccione;
use App\Maquina;


class InstruccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Maquina $maquina)
    {
        $lists = Instruccione::getListIntrucciones($maquina->id);
        $instrucciones_tipo = Instrucciones_tipo::all();
        return view('instrucciones.create', ['maquina' => $maquina, 'instrucciones_tipo' => $instrucciones_tipo, 'lists' => $lists]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInstruccionRequest $request, Maquina $maquina)
    {
        if(Instrucciones_tipo::findOrFail($request->instrucciones_tipo_id)){
            if(Instruccione::setNumeroOrdenCreate($maquina->id, $request->numero_orden))
                $instruccione = Instruccione::create($request->all());
            return redirect('maquinas/'.$maquina->id.'/instrucciones/'.$instruccione->id);
        }
        $messageBag = new MessageBag;
        return back()->withErrors($messageBag->add('error', 'Error al guardar la instrucción en la base de datos.'))->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Maquina $maquina, Instruccione $instruccione)
    {
        if($maquina->id == $instruccione->maquina_id){
            $procedimientos = Procedimiento::getListProcedimiento($instruccione->id);
            $tipo = Instrucciones_tipo::findOrFail($instruccione->instrucciones_tipo_id);
            return view('instrucciones.show', ['instruccion' => $instruccione, 'procedimientos' => $procedimientos, 'maquina' => $maquina, 'tipo' => $tipo]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Maquina $maquina, Instruccione $instruccione)
    {
        $lists = Instruccione::getListIntrucciones($maquina->id);
        $instrucciones_tipo = Instrucciones_tipo::all();
        return view('instrucciones.edit', ['maquina' => $maquina, 'instruccion' => $instruccione, 'instrucciones_tipo' => $instrucciones_tipo, 'lists' => $lists]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditInstruccionRequest $request, Maquina $maquina, Instruccione $instruccione)
    {
        if(Instrucciones_tipo::findOrFail($request->instrucciones_tipo_id)){
            if(Instruccione::setNumeroOrdenEdit($maquina->id, $request->numero_orden, $instruccione->numero_orden))
                $instruccione->update($request->all());
            return redirect('maquinas/'.$maquina->id.'/instrucciones/'.$instruccione->id);
        }
        $messageBag = new MessageBag;
        return back()->withErrors($messageBag->add('error', 'Error al modificar la instrucción en la base de datos.'))->withInput();
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
