<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMaquinaRequest;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('maquinas.index', ['maquinas' => Maquina::getMaquinas()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('maquinas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMaquinaRequest $request)
    {
        $messageBag = new MessageBag;
        if($imagenName = Maquina::setImagenMaquina($request->foto_up)){
            if($qrName = Maquina::setQRMaquina())
                $request->request->add(['imagen' => $imagenName, 'codigo_qr' => $qrName]);

            $maquina = Maquina::create($request->all());
            return redirect('/maquinas/'.$maquina->id)
                    ->withErrors($messageBag->add('success', 'La máquina ha sido registrada exitosamente en la aplicación'))->withInput();
        }
        return back()->withErrors($messageBag->add('foto_up', 'Error al subir la imagen a la base de datos, intente de nuevo'))->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Maquina $maquina)
    {
        $componentes = Componente::getComponentesPaginate($maquina->id, 6);
        $tutoriales = Tutoriale::getTutorialesPaginate($maquina->id, 4);
        $instrucciones = Maquina::getInstruccionesPaginate($maquina->id, 6);
        $galerias = Maquina_imagene::where('maquina_id','=',$maquina->id)->paginate(15);

        return view('maquinas.show', ['maquina' => $maquina, 'componentes' =>  $componentes, 'instrucciones' => $instrucciones, 'tutoriales' => $tutoriales, 'galerias' => $galerias]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Maquina $maquina)
    {
        return view('maquinas.edit', compact('maquina'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditMaquinaRequest $request, Maquina $maquina)
    {
        $messageBag = new MessageBag;
        $request->maquina_id = $maquina->id;
        if($request->cambiarImagen){
            /*
                Validación si el usuario desea modificar la imagen de la máquina
            */
            $request->validate([
                'foto_up' => 'required|mimes:jpg,jpeg,png|max:2500',
            ], [
                'foto_up.required' => 'La imagen de la máquina es requerido',
                'foto_up.mimes' => 'La imagen debe ser un tipo de archivo: jpg, jpeg, png.',
                'foto_up.max' => 'La imagen no debe ser mayor a 2500 kilobytes.',
            ]);
            if($imagenName = Maquina::setImagenMaquina($request->foto_up, $maquina->imagen)){
                $request->request->add(['imagen' => $imagenName, 'codigo_qr' => $maquina->codigo_qr]);
                $maquina->update($request->all());
                return redirect('/maquinas/'.$maquina->id)->withErrors($messageBag->add('success', $maquina->nombre_maquina.' ha sido modificado con exito'))->withInput();
            }
            return back()->withErrors($messageBag->add('foto_up', 'Error al subir la imagen a la base de datos, intente de nuevo'))->withInput();

        }else{
            $request->request->add(['imagen' => $maquina->imagen, 'codigo_qr' => $maquina->codigo_qr]);
            $maquina->update($request->all());
            return redirect('/maquinas/'. $maquina->id)
                    ->withErrors($messageBag->add('success', $maquina->nombre_maquina.' ha sido modificado con exito'))->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maquina $maquina)
    {
        $messageBag = new MessageBag;

        return redirect('maquinas')
             ->withErrors($messageBag->add('success', 'La máquina fue eliminado de la aplicación con exito.'))
             ->withInput();
    }
}
