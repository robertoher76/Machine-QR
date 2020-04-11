<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateComponenteRequest;
use App\Http\Requests\EditComponenteRequest;
use Illuminate\Support\MessageBag;
use App\Componente;
use App\Maquina;

class ComponenteController extends Controller
{
    /**
     * Display a listing of the Componentes.
     *
     * @param  \App\Maquina  $maquina
     * @return \Illuminate\Http\Response
     */
    public function index(Maquina $maquina)
    {
        return view('componentes.index', ['maquina' => $maquina, 'componentes' => Componente::getComponentesPaginate($maquina->id, 100)]);
    }

    /**
     * Show the form for creating a new Componente.
     *
     * @param  \App\Maquina  $maquina
     * @return \Illuminate\Http\Response
     */
    public function create(Maquina $maquina)
    {
        return view('componentes.create', ['maquina' => $maquina, 'lists' => Componente::getComponentes($maquina->id)]);
    }

    /**
     * Store a newly created Componente in storage.
     *
     * @param  \App\Http\Requests\CreateComponenteRequest  $request
     * @param  \App\Maquina  $maquina
     * @return \Illuminate\Http\Response
     */
    public function store(CreateComponenteRequest $request, Maquina $maquina)
    {
        $messageBag = new MessageBag;
        if($imagenName = Componente::setImagenComponente($request->foto_up)){
            if(Componente::setNumeroOrdenCreate($maquina->id, $request->numero_orden)){
                $request->request->add(['imagen' => $imagenName, 'maquina_id' => $maquina->id]);
                $componente = Componente::create($request->all());
                return redirect("/maquinas/$maquina->id/componente/$componente->id")->withErrors($messageBag->add('success', 'El componente ha sido registrado en la aplicación con exito.'));
            }
        }
        return back()->withErrors($messageBag->add('error', 'Error al subir la imagen a la base de datos, intente de nuevo'));
    }

    /**
     * Display the specified Componente.
     *
     * @param  \App\Maquina  $maquina
     * @param  \App\Componente  $componente
     * @return \Illuminate\Http\Response
     */
    public function show(Maquina $maquina, Componente $componente)
    {
        if($componente->maquina_id == $maquina->id){
            return view('componentes.show', compact('maquina'), compact('componente'));
        }
    }

    /**
     * Show the form for editing the specified Componente.
     *
     * @param  \App\Maquina  $maquina
     * @param  \App\Componente  $componente
     * @return \Illuminate\Http\Response
     */
    public function edit(Maquina $maquina, Componente $componente)
    {
        if($componente->maquina_id == $maquina->id){
            return view('componentes.edit', ['maquina' => $maquina, 'componente' => $componente,'lists' => Componente::getComponentes($maquina->id)]);
        }
    }

    /**
     * Update the specified Componente in storage.
     *
     * @param  \App\Http\Requests\EditComponenteRequest  $request
     * @param  \App\Maquina  $maquina
     * @param  \App\Componente  $componente
     * @return \Illuminate\Http\Response
     */
    public function update(EditComponenteRequest $request, Maquina $maquina, Componente $componente)
    {
        $messageBag = new MessageBag;
        if($componente->maquina_id == $maquina->id && Componente::setNumeroOrdenEdit($maquina->id, $request->numero_orden, $componente->numero_orden)){
            if($request->cambiarImagen){
                $request->validate([
                    'foto_up' => 'required|mimes:jpg,jpeg,png|max:4000'], [
                    'foto_up.required' => 'La imagen del componente es requerido.',
                    'foto_up.mimes' => 'La imagen debe ser un tipo de archivo: jpg, jpeg, png.',
                    'foto_up.max' => 'La imagen no debe ser mayor a 4000 kilobytes.'
                ]);
                if($imagenName = Componente::setImagenComponente($request->foto_up, $componente->imagen)){
                    $request->request->add(['imagen' => $imagenName, 'maquina_id' => $maquina->id]);
                    $componente->update($request->all());
                    return redirect("maquinas/$maquina->id/componente/$componente->id")->withErrors($messageBag->add('success', 'El componente fue modificado exitosamente.'));
                }
                return back()->withErrors($messageBag->add('error', 'Error al subir la imagen a la base de datos, intente de nuevo'));
            }
            $request->request->add(['imagen' => $componente->imagen, 'maquina_id' => $maquina->id]);
            $componente->update($request->all());
            return redirect("maquinas/$maquina->id/componente/$componente->id")->withErrors($messageBag->add('success', 'El componente fue modificado exitosamente'));
        }
    }

    /**
     * Remove the specified Componente from storage.
     *
     * @param  \App\Maquina  $maquina
     * @param  \App\Componente  $componente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maquina $maquina, Componente $componente)
    {
        $messageBag = new MessageBag;
        if($maquina->id == $componente->maquina_id){
            if(Componente::deleteImagenComponente($componente->imagen) && Componente::updateOrdenDecrease($maquina->id,false,$componente->numero_orden)){
                $componente->delete();
                return redirect("maquinas/$maquina->id/componente")->withErrors($messageBag->add('success', 'El componente fue eliminado de la aplicación exitosamente'));
            }
        }
        return back()->withErrors($messageBag->add('error', 'No se puede eliminar este componente de la aplicación'));
    }
}
