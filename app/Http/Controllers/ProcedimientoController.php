<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProcedimientoRequest;
use App\Http\Requests\EditProcedimientoRequest;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use App\Maquina;
use App\Instruccione;
use App\Procedimiento;

class ProcedimientoController extends Controller
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
    public function create(Instruccione $instruccione)
    {
        return view('instrucciones.procedimientos.create', ['instruccione' => $instruccione, 'lists' => Procedimiento::getListProcedimiento($instruccione->id)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CreateProcedimientoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProcedimientoRequest $request, Instruccione $instruccione)
    {
        if($request->instruccione_id == $instruccione->id){
            if($imagenName = Procedimiento::setImagenProcedimiento($request->foto_up)){
                if(Procedimiento::setNumero_Orden($request->numero_orden, $instruccione->id)){
                    $request->request->add(['imagen' => $imagenName]);

                    Procedimiento::create($request->all());
                    return redirect('maquinas/instrucciones/'.$instruccione->id);
                }
                Procedimiento::setDeleteImagenProcedimiento($imagenName);
                $messageBag = new MessageBag;
                return back()->withErrors($messageBag->add('error', 'Error al guardar el procedimiento en la base de datos.'))->withInput();
            }
        }
        $messageBag = new MessageBag;
        return back()->withErrors($messageBag->add('foto_up', 'Error al subir la imagen a la base de datos, intente de nuevo'))->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Instruccione $instruccione, Procedimiento $procedimiento)
    {
        return view('instrucciones.procedimientos.show', ['instruccione' => $instruccione, 'procedimiento' => $procedimiento]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Instruccione $instruccione, Procedimiento $procedimiento)
    {
        if($instruccione->id == $procedimiento->instruccione_id){
            return view('instrucciones.procedimientos.edit', ['instruccione' => $instruccione, 'procedimiento' => $procedimiento, 'lists' => Procedimiento::getListProcedimiento($instruccione->id)]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditProcedimientoRequest $request, Instruccione $instruccione, Procedimiento $procedimiento)
    {
        if($procedimiento->instruccione_id == $instruccione->id){
            if($request->cambiarImagen){
                $request->validate([
                    'foto_up' => 'required|mimes:jpg,jpeg,png|max:2500',
                ], [
                    'foto_up.required' => 'La imagen del componente es requerido.',
                    'foto_up.mimes' => 'La imagen debe ser un tipo de archivo: jpg, jpeg, png.',
                    'foto_up.max' => 'La imagen no debe ser mayor a 2500 kilobytes.',
                ]);
                if($imagenName = Procedimiento::setImagenProcedimiento($request->foto_up, $procedimiento->imagen)){
                    $request->request->add(['imagen' => $imagenName]);
                }else{
                    $messageBag = new MessageBag;
                    return back()->withErrors($messageBag->add('foto_up', 'Error al subir la imagen a la base de datos, intente de nuevo'))->withInput();
                }
            }
            if(Procedimiento::getUpdateOrdenEdit($instruccione->id, $procedimiento->id, $procedimiento->numero_orden, $request->numero_orden)){
                $procedimiento->update($request->all());
                return redirect('maquinas/instrucciones/'.$instruccione->id);
            }
        }
        $messageBag = new MessageBag;
        return back()->withErrors($messageBag->add('error', 'Error al modificar el procedimiento en la base de datos.'))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instruccione $instruccione, Procedimiento $procedimiento)
    {
        try{
            if($instruccione->id == $procedimiento->instruccione_id){
                if(Procedimiento::setNumero_OrdenDelete($procedimiento->numero_orden, $instruccione->id)){
                    $procedimiento->delete();
                    return redirect('maquinas/instrucciones/'.$instruccione->id);
                }
            }
        }catch(Exception $ex){
            $messageBag = new MessageBag;
            return back()->withErrors($messageBag->add('error', 'Error, no se puede eliminar este procedimiento de la base de datos.'))->withInput();
        }
    }
}
