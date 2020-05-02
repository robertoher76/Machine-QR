<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateImagenRequest;
use App\Http\Requests\EditImagenRequest;
use Illuminate\Support\MessageBag;
use App\Maquina_imagene;
use App\Maquina;

class ImagenController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index','show');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Maquina $maquina
     * @return \Illuminate\Http\Response
     */
    public function index(Maquina $maquina)
    {
        $galeria = Maquina_imagene::getGaleria($maquina->id, 10);
        return view('galerias.index', ['maquina' => $maquina, 'imagenes' =>$galeria]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Maquina $maquina
     * @return \Illuminate\Http\Response
     */
    public function create(Maquina $maquina)
    {
        return view('galerias.create', ['maquina' => $maquina]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateImagenRequest  $request
     * @param  \App\Maquina $maquina
     * @return \Illuminate\Http\Response
     */
    public function store(CreateImagenRequest $request, Maquina $maquina)
    {
        $messageBag = new MessageBag;
        try{
            if($imagenName = Maquina_imagene::setImagenGaleria($request->foto_up)){
                $request->request->add(['imagen' => $imagenName, 'maquina_id' => $maquina->id, 'numero_orden' => Maquina_imagene::setNumeroOrden($maquina->id)]);
                $imagen = Maquina_imagene::create($request->all());
                return redirect("maquinas/$maquina->id/galeria/$imagen->id")->withErrors($messageBag->add('success', 'La imagen fue añadida a la galería exitosamente.'));
            }
        }catch(\Exception $ex){
            return back()->withErrors($messageBag->add('error', 'Error al subir la imagen a la base de datos, intente de nuevo'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Maquina_imagene  $galerium
     * @return \Illuminate\Http\Response
     */
    public function show(Maquina_imagene  $galerium)
    {
        return view('galerias.show', ['maquina' => Maquina::find($galerium->maquina_id), 'galeria' => $galerium]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Maquina_imagene  $galerium
     * @return \Illuminate\Http\Response
     */
    public function edit(Maquina_imagene  $galerium)
    {        
        return view('galerias.edit', ['maquina' => Maquina::find($galerium->maquina_id), 'imagen' => $galerium]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EditImagenRequest  $request
     * @param  Maquina_imagene  $galerium
     * @return \Illuminate\Http\Response
     */
    public function update(EditImagenRequest $request, Maquina_imagene  $galerium)
    {
        $messageBag = new MessageBag;        
        if($request->cambiarImagn){
            $request->validate([
                'foto_up' => 'required|mimes:jpg,jpeg,png|max:4000'], [
                'foto_up.required' => 'La imagen es requerido.',
                'foto_up.mimes' => 'La imagen debe ser un tipo de archivo: jpg, jpeg, png.',
                'foto_up.max' => 'La imagen no debe ser mayor a 4000 kilobytes.'
            ]);
            if($imagenName = Maquina_imagene::setImagenGaleria($request->foto_up, $galerium->imagen)){
                $request->request->add(['imagen' => $imagenName]);
            }
            return back()->withErrors($messageBag->add('error', 'Error al subir la imagen a la base de datos, intente de nuevo'));
        }
        $galerium->update($request->all());
        return redirect("galeria/$galerium->id")->withErrors($messageBag->add('success', 'La imagen fue modificada en la aplicación con éxito.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Maquina_imagene  $galerium
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maquina_imagene  $galerium)
    {
        $messageBag = new MessageBag;
        try{
            if(Maquina_imagene::deleteImagenGaleria($galerium->imagen) && Maquina_imagene::updateOrdenDecrease($galerium->maquina_id, $galerium->numero_orden)){
                $id = $galerium->maquina_id;
                $galerium->delete();
                return redirect("maquinas/$id/galeria")->withErrors($messageBag->add('success', 'La imagen fue eliminada de la galería.'));
            }
        }catch(\Exception $ex){
            return back()->withErrors($messageBag->add('error', 'Error al elminiar la imagen en la base de datos, intente de nuevo'));
        }
    }
}
