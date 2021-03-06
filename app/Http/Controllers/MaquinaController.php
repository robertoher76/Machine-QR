<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMaquinaRequest;
use App\Http\Requests\ImagenMaquinaRequest;
use App\Http\Requests\EditMaquinaRequest;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use App\Maquina_imagene;
use App\Componente;
use App\Tutoriale;
use App\Maquina;

class MaquinaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index','show');
    }

    /**
     * Display a listing of the Máquinas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('maquinas.index', ['maquinas' => Maquina::getMaquinas()]);
    }

    /**
     * Show the form for creating a new Máquina.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('maquinas.create');
    }

    /**
     * Store a newly created Máquina in storage.
     *
     * @param  \App\Http\Requests\CreateMaquinaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMaquinaRequest $request)
    {
        $messageBag = new MessageBag;
        if($imagenName = Maquina::setImagenMaquina($request->foto_up)){
            if($qrName = Maquina::setQRMaquina()){
                $request->request->add(['imagen' => $imagenName, 'codigo_qr' => $qrName]);
                $maquina = Maquina::create($request->all());
                return redirect("maquinas/$maquina->id")->withErrors($messageBag->add('success', 'La máquina ha sido registrada exitosamente en la aplicación'));
            }
        }
        return back()->withErrors($messageBag->add('foto_up', 'Error al subir la imagen a la base de datos, intente de nuevo'));
    }

    /**
     * Display the specified Máquina.
     *
     * @param  \App\Maquina  $maquina
     * @return \Illuminate\Http\Response
     */
    public function show(Maquina $maquina)
    {
        $componentes = Componente::getComponentesPaginate($maquina->id, 6);
        $tutoriales = Tutoriale::getTutorialesPaginate($maquina->id, 4);
        $instrucciones = Maquina::getInstruccionesPaginate($maquina->id, 6);
        $galerias = Maquina_imagene::where('maquina_id','=',$maquina->id)->orderBy('numero_orden')->paginate(15);
        return view('maquinas.show', ['maquina' => $maquina, 'componentes' =>  $componentes, 'instrucciones' => $instrucciones, 'tutoriales' => $tutoriales, 'galerias' => $galerias]);
    }

    /**
     * Show the form for editing the specified Máquina.
     *
     * @param  \App\Maquina  $maquina
     * @return \Illuminate\Http\Response
     */
    public function edit(Maquina $maquina)
    {
        return view('maquinas.edit', compact('maquina'));
    }

    /**
     * Update the specified Máquina in storage.
     *
     * @param  \App\Http\Requests\EditMaquinaRequest  $request
     * @param  \App\Maquina  $maquina
     * @return \Illuminate\Http\Response
     */
    public function update(EditMaquinaRequest $request, Maquina $maquina)
    {
        $messageBag = new MessageBag;        
        $maquina->update($request->all());
        return redirect("maquinas/$maquina->id")->withErrors($messageBag->add('success', $maquina->nombre_maquina.' ha sido modificado con exito'));
    }

    /**
     * Remove the specified Máquina from storage.
     *
     * @param  \App\Maquina  $maquina
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maquina $maquina)
    {
        $messageBag = new MessageBag;
        return redirect('maquinas')->withErrors($messageBag->add('success', 'La máquina fue eliminado de la aplicación con exito.'));
    }

    /**
     * Show the form for update a Imagen Perfil Máquina.
     *
     * @param  \App\Maquina  $maquina
     * @return \Illuminate\Http\Response
     */
    public function uploadImagen(Maquina $maquina){
        return view('maquinas.upload', compact('maquina'));
    }

    /**
     * Update imagen Máquina in storage.
     *
     * @param  \App\Http\Requests\ImagenMaquinaRequest  $request
     * @param  \App\Maquina  $maquina
     * @return \Illuminate\Http\Response
     */
    public function saveImagen(ImagenMaquinaRequest $request, Maquina $maquina){
        try{
            $messageBag = new MessageBag;
            if($imagenName = Maquina::setImagenMaquina($request->foto_up, $maquina->imagen)){
                $maquina->imagen = $imagenName;
                $maquina->update();
                return redirect("maquinas/$maquina->id")->withErrors($messageBag->add('success', "La imagen de perfil de $maquina->maquina_nombre ha sido modificado con éxtio."));
            }      
        }catch(\Exception $ex){
            return back()->withErrors($messageBag->add('error', 'Error al subir la imagen a la base de datos, intente de nuevo'));
        }
    }

    /**
     * Show the galería for update a Imagen Perfil Máquina.
     *
     * @param  \App\Maquina  $maquina
     * @return \Illuminate\Http\Response
     */
    public function showGaleria(Maquina $maquina){
        $galeria = Maquina_imagene::getGaleria($maquina->id, 10);
        return view('galerias.select', ['maquina' => $maquina, 'imagenes' => $galeria]);
    }

    /**
     * Update imagen Máquina in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Maquina  $maquina
     * @return \Illuminate\Http\Response
     */
    public function updateImagen(Request $request, Maquina $maquina){
        $messageBag = new MessageBag;
        if($request->id && Maquina_imagene::verificarImagenMaquina($maquina->id, $request->id)){
            $imagen = Maquina_imagene::findOrFail($request->id);
            if(Maquina::copyImagenGaleria($imagen->imagen, $maquina->imagen)){
                $maquina->imagen = $imagen->imagen;
                $maquina->update();
                return redirect("maquinas/$maquina->id")->withErrors($messageBag->add('success', "La imagen de perfil de $maquina->maquina_nombre ha sido modificado con éxtio."));             
            }
        }
        return back()->withErrors($messageBag->add('error', 'Error al subir la imagen a la base de datos, intente de nuevo'));
    }
}
