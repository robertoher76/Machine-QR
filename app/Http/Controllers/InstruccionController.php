<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInstruccionRequest;
use App\Http\Requests\EditInstruccionRequest;
use Illuminate\Support\MessageBag;
use App\Instrucciones_tipo;
use App\Procedimiento;
use App\Instruccione;
use App\Maquina;


class InstruccionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the Instrucciones.
     *
     * @param  \App\Maquina  $maquina
     * @return \Illuminate\Http\Response
     */
    public function index(Maquina $maquina)
    {
        return view('instrucciones.index', ['instrucciones' => Instruccione::getIntruccionesPaginate($maquina->id), 'maquina' => $maquina]);
    }

    /**
     * Show the form for creating a new Instrucción.
     *
     * @param  \App\Maquina  $maquina
     * @return \Illuminate\Http\Response
     */
    public function create(Maquina $maquina)
    {
        $lists = Instruccione::getIntrucciones($maquina->id);
        return view('instrucciones.create', ['maquina' => $maquina, 'instrucciones_tipo' => Instrucciones_tipo::all(), 'lists' => $lists]);
    }

    /**
     * Store a newly created Instrucción in storage.
     *
     * @param  \App\Http\Requests\CreateInstruccionRequest  $request
     * @param  \App\Maquina  $maquina
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInstruccionRequest $request, Maquina $maquina)
    {
        $messageBag = new MessageBag;
        if(Instrucciones_tipo::findOrFail($request->instrucciones_tipo_id)){
            if(Instruccione::setNumeroOrdenCreate($maquina->id, $request->numero_orden)){
                $request->request->add(['maquina_id' => $maquina->id]);
                $instruccione = Instruccione::create($request->all());
                return redirect("instrucciones/$instruccione->id")->withErrors($messageBag->add('success', "$instruccione->titulo ha sido registado en la aplicación con éxito"));
            }
        }
        return back()->withErrors($messageBag->add('error', 'Error al guardar la instrucción en la base de datos.'));
    }

    /**
     * Display the specified Instrucción.
     *
     * @param  \App\Instruccione $instruccione
     * @return \Illuminate\Http\Response
     */
    public function show(Instruccione $instruccione)
    {        
        $procedimientos = Procedimiento::getListProcedimiento($instruccione->id);
        $tipo = Instrucciones_tipo::findOrFail($instruccione->instrucciones_tipo_id);
        return view('instrucciones.show', ['instruccion' => $instruccione, 'procedimientos' => $procedimientos, 'maquina' => Maquina::find($instruccione->id), 'tipo' => $tipo]);
    }

    /**
     * Show the form for editing the specified Instrucción.
     *
     * @param  \App\Instruccione $instruccione
     * @return \Illuminate\Http\Response
     */
    public function edit(Instruccione $instruccione)
    {
        $lists = Instruccione::getIntrucciones($instruccione->maquina_id);
        return view('instrucciones.edit', ['maquina' => Maquina::find($instruccione->id), 'instruccion' => $instruccione, 'instrucciones_tipo' => Instrucciones_tipo::all(), 'lists' => $lists]);
    }

    /**
     * Update the specified Instrucción in storage.
     *
     * @param  \App\Http\Requests\EditInstruccionRequest  $request
     * @param  \App\Instruccione $instruccione
     * @return \Illuminate\Http\Response
     */
    public function update(EditInstruccionRequest $request, Instruccione $instruccione)
    {
        $messageBag = new MessageBag;
        if(Instrucciones_tipo::findOrFail($request->instrucciones_tipo_id)){
            if(Instruccione::setNumeroOrdenEdit($instruccione->maquina_id, $request->numero_orden, $instruccione->numero_orden))
                $instruccione->update($request->all());
            return redirect("instrucciones/$instruccione->id")->withErrors($messageBag->add('success', "$instruccione->titulo fue modificado con exito."));
        }
        return back()->withErrors($messageBag->add('error', 'Error al modificar la instrucción en la base de datos.'));
    }

    /**
     * Remove the specified Instrucción from storage.
     *
     * @param  \App\Instruccione $instruccione
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instruccione $instruccione)
    {
        $messageBag = new MessageBag;
        if(count(Procedimiento::getListProcedimiento($instruccione->id)) == 0){
            if(Instruccione::updateOrdenDecrease($instruccione->maquina_id,false,$instruccione->numero_orden)){
                $id = $instruccione->maquina_id;
                $instruccione->delete();
                return redirect("maquinas/$id/instrucciones")->withErrors($messageBag->add('success', 'La Instrucción fue eliminada de la aplicación con exito.'));
            }
        }
        return back()->withErrors($messageBag->add('error', 'No se puede eliminar la instrucción debido a que posee procedimientos asociados.'));
    }
}
