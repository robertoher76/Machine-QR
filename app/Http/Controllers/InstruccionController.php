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
                $instruccione = Instruccione::create($request->all());
                return redirect("maquinas/$maquina->id/instrucciones/$instruccione->id")->withErrors($messageBag->add('success', 'La Instrucción ha sido registada en la aplicación con éxito'));
            }
        }
        return back()->withErrors($messageBag->add('error', 'Error al guardar la instrucción en la base de datos.'));
    }

    /**
     * Display the specified Instrucción.
     *
     * @param  \App\Maquina  $maquina
     * @param  \App\Instruccione $instruccione
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
     * Show the form for editing the specified Instrucción.
     *
     * @param  \App\Maquina  $maquina
     * @param  \App\Instruccione $instruccione
     * @return \Illuminate\Http\Response
     */
    public function edit(Maquina $maquina, Instruccione $instruccione)
    {
        if($maquina->id == $instruccione->maquina_id){
            $lists = Instruccione::getIntrucciones($maquina->id);
            return view('instrucciones.edit', ['maquina' => $maquina, 'instruccion' => $instruccione, 'instrucciones_tipo' => Instrucciones_tipo::all(), 'lists' => $lists]);
        }
    }

    /**
     * Update the specified Instrucción in storage.
     *
     * @param  \App\Http\Requests\EditInstruccionRequest  $request
     * @param  \App\Maquina  $maquina
     * @param  \App\Instruccione $instruccione
     * @return \Illuminate\Http\Response
     */
    public function update(EditInstruccionRequest $request, Maquina $maquina, Instruccione $instruccione)
    {
        $messageBag = new MessageBag;
        if($maquina->id == $instruccione->maquina_id && Instrucciones_tipo::findOrFail($request->instrucciones_tipo_id)){
            if(Instruccione::setNumeroOrdenEdit($maquina->id, $request->numero_orden, $instruccione->numero_orden))
                $instruccione->update($request->all());
            return redirect('maquinas/'.$maquina->id.'/instrucciones/'.$instruccione->id)
                    ->withErrors($messageBag->add('success', 'La Instrucción fue modificada exitosamente'))
                    ->withInput();
        }
        return back()->withErrors($messageBag->add('error', 'Error al modificar la instrucción en la base de datos.'))->withInput();
    }

    /**
     * Remove the specified Instrucción from storage.
     *
     * @param  \App\Maquina  $maquina
     * @param  \App\Instruccione $instruccione
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maquina $maquina, Instruccione $instruccione)
    {
        $messageBag = new MessageBag;
        if($instruccione->maquina_id == $maquina->id){
            if(count(Procedimiento::getListProcedimiento($instruccione->id)) == 0){
                if(Instruccione::updateOrdenDecrease($maquina->id,false,$instruccione->numero_orden)){
                    $instruccione->delete();
                    return redirect('maquinas/'.$maquina->id . '/instrucciones')
                            ->withErrors($messageBag->add('success', 'La Instrucción fue eliminada exitosamente de la aplicación.'))
                            ->withInput();
                }
            }
            return back()->withErrors($messageBag->add('error', 'No se puede eliminar la Instrucción debido a que posee procedimientos asociados.'))->withInput();
        }
    }
}
