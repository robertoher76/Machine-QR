<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProcedimientoRequest;
use App\Http\Requests\EditProcedimientoRequest;
use Illuminate\Support\MessageBag;
use App\Procedimiento;
use App\Instruccione;
use App\Maquina;

class ProcedimientoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @param \App\Instruccione $instruccione
     * @return \Illuminate\Http\Response
     */
    public function index(Instruccione $instruccione)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Instruccione $instruccione
     * @return \Illuminate\Http\Response
     */
    public function create(Instruccione $instruccione)
    {
        return view('instrucciones.procedimientos.create', ['instruccione' => $instruccione, 'lists' => Procedimiento::getListProcedimiento($instruccione->id)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateProcedimientoRequest  $request
     * @param \App\Instruccione $instruccione
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProcedimientoRequest $request, Instruccione $instruccione)
    {
        $messageBag = new MessageBag;
        if($imagenName = Procedimiento::setImagenProcedimiento($request->foto_up)){
            if(Procedimiento::setNumeroOrdenCreate($instruccione->id, $request->numero_orden)){
                $request->request->add(['imagen' => $imagenName, 'instruccione_id' => $instruccione->id]);
                Procedimiento::create($request->all());
                return redirect("instrucciones/$instruccione->id")->withErrors($messageBag->add('success', 'El Procedimiento ha sido registado en la aplicación con éxito'));
            }
            Procedimiento::setDeleteImagenProcedimiento($imagenName);
            return back()->withErrors($messageBag->add('error', 'Error al guardar el procedimiento en la base de datos.'));
        }
        return back()->withErrors($messageBag->add('error', 'Error al subir la imagen a la base de datos, intente de nuevo'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Procedimiento $procedimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Procedimiento $procedimiento)
    {
        return view('instrucciones.procedimientos.show', ['instruccione' => Instruccione::find($procedimiento->instruccione_id), 'procedimiento' => $procedimiento]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Procedimiento $procedimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Procedimiento $procedimiento)
    {        
        return view('instrucciones.procedimientos.edit', ['instruccione' => Instruccione::find($procedimiento->instruccione_id), 'procedimiento' => $procedimiento, 'lists' => Procedimiento::getListProcedimiento($procedimiento->instruccione_id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EditProcedimientoRequest  $request
     * @param  \App\Procedimiento $procedimiento
     * @return \Illuminate\Http\Response
     */
    public function update(EditProcedimientoRequest $request, Procedimiento $procedimiento)
    {
        $messageBag = new MessageBag;
        if($request->cambiarImagen){
            $request->validate([
                'foto_up' => 'required|mimes:jpg,jpeg,png|max:4000'],
            [
                'foto_up.required' => 'La imagen del componente es requerido.',
                'foto_up.mimes' => 'La imagen debe ser un tipo de archivo: jpg, jpeg, png.',
                'foto_up.max' => 'La imagen no debe ser mayor a 4000 kilobytes.',
            ]);
            if($imagenName = Procedimiento::setImagenProcedimiento($request->foto_up, $procedimiento->imagen)){
                $request->request->add(['imagen' => $imagenName]);
            }else{
                return back()->withErrors($messageBag->add('error', 'Error al subir la imagen a la base de datos, intente de nuevo'));
            }
        }
        if(Procedimiento::setNumeroOrdenEdit($procedimiento->instruccione_id, $request->numero_orden, $procedimiento->numero_orden)){            
            $procedimiento->update($request->all());
            return redirect("instrucciones/$procedimiento->instruccione_id")->withErrors($messageBag->add('success', 'El procedimiento ha sido modificado en la aplicación con éxito.'));
        }
        return back()->withErrors($messageBag->add('error', 'Error al modificar el procedimiento en la base de datos.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Procedimiento $procedimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Procedimiento $procedimiento)
    {
        try{
            $messageBag = new MessageBag;
            if(Procedimiento::updateOrdenDecrease($procedimiento->instruccione_id,false,$procedimiento->numero_orden)){
                $id = $procedimiento->instruccione_id;
                $procedimiento->delete();
                return redirect("/instrucciones/$id")->withErrors($messageBag->add('success', 'El procedimiento ha sido eliminado de la aplicación con éxito.'));
            }        
        }catch(\Exception $ex){
            return back()->withErrors($messageBag->add('error', 'No se puede eliminar este procedimiento de la base de datos.'));
        }
    }
}
