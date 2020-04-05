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
        $messageBag = new MessageBag;
        if($imagenName = Procedimiento::setImagenProcedimiento($request->foto_up)){
            if(Procedimiento::setNumeroOrdenCreate($instruccione->id, $request->numero_orden)){
                $request->request->add(['imagen' => $imagenName]);
                $request->instruccione_id = $instruccione->id;
                Procedimiento::create($request->all());
                return redirect('maquinas/'.$instruccione->maquina_id.'/instrucciones/'.$instruccione->id)
                     ->withErrors($messageBag->add('success', 'El Procedimiento ha sido registado en la aplicación con éxito'));
            }
            Procedimiento::setDeleteImagenProcedimiento($imagenName);
            return back()->withErrors($messageBag->add('error', 'Error al guardar el procedimiento en la base de datos.'))->withInput();
        }
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
        $messageBag = new MessageBag;
        if($procedimiento->instruccione_id == $instruccione->id){
            if($request->cambiarImagen){
                $request->validate([
                    'foto_up' => 'required|mimes:jpg,jpeg,png|max:2500'],
                [
                    'foto_up.required' => 'La imagen del componente es requerido.',
                    'foto_up.mimes' => 'La imagen debe ser un tipo de archivo: jpg, jpeg, png.',
                    'foto_up.max' => 'La imagen no debe ser mayor a 2500 kilobytes.',
                ]);
                if($imagenName = Procedimiento::setImagenProcedimiento($request->foto_up, $procedimiento->imagen)){
                    $request->request->add(['imagen' => $imagenName]);
                }else{
                    return back()->withErrors($messageBag->add('foto_up', 'Error al subir la imagen a la base de datos, intente de nuevo'))->withInput();
                }
            }
            if(Procedimiento::setNumeroOrdenEdit($instruccione->id, $request->numero_orden, $procedimiento->numero_orden)){
                $procedimiento->instruccione_id = $instruccione->id;
                $procedimiento->update($request->all());
                return redirect('maquinas/'.$instruccione->maquina_id.'/instrucciones/'.$instruccione->id)
                        ->withErrors($messageBag->add('success', 'El procedimiento ha sido modificado exitosamente.'))->withInput();
            }
        }
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
            $messageBag = new MessageBag;
            if($instruccione->id == $procedimiento->instruccione_id){
                if(Procedimiento::updateOrdenDecrease($instruccione->id,false,$procedimiento->numero_orden)){
                    $procedimiento->delete();
                    return redirect('maquinas/'.$instruccione->maquina_id.'/instrucciones/'.$instruccione->id)
                            ->withErrors($messageBag->add('success', 'El procedimiento ha sido eliminado exitosamente de la base de datos.'))->withInput();
                }
            }
        }catch(\Exception $ex){
            return back()->withErrors($messageBag->add('error', 'No se puede eliminar este procedimiento de la base de datos.'))->withInput();
        }
    }
}
