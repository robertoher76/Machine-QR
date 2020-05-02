<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateComponenteRequest;
use App\Http\Requests\EditComponenteRequest;
use Illuminate\Support\MessageBag;
use App\Componente;
use App\Maquina;

class ComponenteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index','show');
    }

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
                return redirect("componentes/$componente->id")->withErrors($messageBag->add('success', "$componente->nombre fue registrado en la aplicación con exito."));
            }
        }
        return back()->withErrors($messageBag->add('error', 'Error al subir la imagen a la base de datos, intente de nuevo'));
    }

    /**
     * Display the specified Componente.
     *
     * @param  \App\Componente  $componente
     * @return \Illuminate\Http\Response
     */
    public function show(Componente $componente)
    {
        
        return view('componentes.show', ['componente' => $componente, 'maquina' => Maquina::find($componente->maquina_id)]);
    }

    /**
     * Show the form for editing the specified Componente.
     *
     * @param  \App\Componente  $componente
     * @return \Illuminate\Http\Response
     */
    public function edit(Componente $componente)
    {
        return view('componentes.edit', ['componente' => $componente, 'maquina' => Maquina::find($componente->maquina_id),'lists' => Componente::getComponentes($componente->maquina_id)]);
    }

    /**
     * Update the specified Componente in storage.
     *
     * @param  \App\Http\Requests\EditComponenteRequest  $request
     * @param  \App\Componente  $componente
     * @return \Illuminate\Http\Response
     */
    public function update(EditComponenteRequest $request, Componente $componente)
    {
        $messageBag = new MessageBag;
        if(Componente::setNumeroOrdenEdit($componente->maquina_id, $request->numero_orden, $componente->numero_orden)){
            if($request->cambiarImagen){
                $request->validate([
                    'foto_up' => 'required|mimes:jpg,jpeg,png|max:4000'], [
                    'foto_up.required' => 'La imagen del componente es requerido.',
                    'foto_up.mimes' => 'La imagen debe ser un tipo de archivo: jpg, jpeg, png.',
                    'foto_up.max' => 'La imagen no debe ser mayor a 4000 kilobytes.'
                ]);
                if($imagenName = Componente::setImagenComponente($request->foto_up, $componente->imagen)){
                    $request->request->add(['imagen' => $imagenName]);                    
                }else{
                    return back()->withErrors($messageBag->add('error', 'Error al subir la imagen a la base de datos, intente de nuevo'));
                }
            }            
            $componente->update($request->all());
            return redirect("componentes/$componente->id")->withErrors($messageBag->add('success', "$componente->nombre fue modificado en la aplicación con exito."));
        }
    }

    /**
     * Remove the specified Componente from storage.
     *
     * @param  \App\Componente  $componente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Componente $componente)
    {
        $messageBag = new MessageBag;
        if(Componente::deleteImagenComponente($componente->imagen) && Componente::updateOrdenDecrease($componente->maquina_id,false,$componente->numero_orden)){
            $id = $componente->maquina_id;
            $componente->delete();
            return redirect("maquinas/$id/componentes")->withErrors($messageBag->add('success', 'El Componente fue eliminado de la aplicación con exito.'));
        }
        return back()->withErrors($messageBag->add('error', 'No se puede eliminar este componente de la aplicación'));
    }
}
