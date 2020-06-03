<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTutorialRequest;
use App\Http\Requests\EditTutorialRequest;
use Illuminate\Support\MessageBag;
use App\Tutoriale;
use App\Maquina;

class TutorialController extends Controller
{
    /**
     * Display a listing of the Tutoriales.
     *
     * @param  \App\Maquina $maquina
     * @return \Illuminate\Http\Response
     */
    public function index(Maquina $maquina)
    {
        return view('tutoriales.index', compact('maquina'), ['tutoriales' => Tutoriale::getTutorialesPaginate($maquina->id, 10)]);
    }

    /**
     * Show the form for creating a new Tutorial.
     *
     * @param  \App\Maquina $maquina
     * @return \Illuminate\Http\Response
     */
    public function create(Maquina $maquina)
    {
        return view('tutoriales.create', ['maquina' => $maquina, 'lists' => Tutoriale::getTutoriales($maquina->id)]);
    }

    /**
     * Store a newly created Tutorial in storage.
     *
     * @param  \App\Http\Requests\CreateTutorialRequest  $request
     * @param  \App\Maquina $maquina
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTutorialRequest $request, Maquina $maquina)
    {
        $messageBag = new MessageBag;
        if($videoName = Tutoriale::setTutorialMaquina($request->video_up)){
            if(Tutoriale::setNumeroOrdenCreate($maquina->id, $request->numero_orden)){
                $request->request->add(['video' => $videoName, 'maquina_id' => $maquina->id]);
                Tutoriale::create($request->all());
                return redirect("maquinas/$maquina->id/tutoriales")->withErrors($messageBag->add('success', 'Tutorial añdadido con exito en la aplicación.'));
            }
        }
        return back()->withErrors($messageBag->add('error', 'Error al subir el video a la base de datos, intente de nuevo'));
    }

    /**
     * Display the specified Tutorial.
     *
     * @param  \App\Maquina $maquina
     * @return \Illuminate\Http\Response
     */
    public function show(Maquina $maquina, Tutoriale $tutoriale)
    {
        if($maquina->id == $tutoriale->maquina_id){
            return view('tutoriales.show', compact('maquina'), compact('tutoriale'));
        }
    }

    /**
     * Show the form for editing the specified Tutorial.
     *
     * @param  \App\Maquina $maquina
     * @param  \App\Tutoriale $tutoriale
     * @return \Illuminate\Http\Response
     */
    public function edit(Maquina $maquina, Tutoriale $tutoriale)
    {
        if($maquina->id == $tutoriale->maquina_id){
            return view('tutoriales.edit', ['tutoriale' => $tutoriale, 'maquina' => $maquina, 'lists' => Tutoriale::getTutoriales($maquina->id)]);
        }
    }

    /**
     * Update the specified Tutorial in storage.
     *
     * @param  \App\Http\Requests\EditTutorialRequest  $request
     * @param  \App\Maquina $maquina
     * @param  \App\Tutoriale $tutoriale
     * @return \Illuminate\Http\Response
     */
    public function update(EditTutorialRequest $request, Maquina $maquina, Tutoriale $tutoriale)
    {
        $messageBag = new MessageBag;
        if($maquina->id == $tutoriale->maquina_id){
            if($request->cambiarImagen){
                $request->validate([
                    'video_up' => 'required|mimes:jpg,jpeg,png|max:100000'],[
                    'video_up.required' => 'El video tutorial es requerido.',
                    'video_up.mimes' => 'El video tutorial debe ser un tipo de archivo: mp4.',
                    'video_up.max' => 'El video no debe ser mayor a 100000 kilobytes.'
                ]);
                if($videoName = Tutoriale::setTutorialMaquina($request->video_up, $tutoriale->video)){
                    if(Tutoriale::setNumeroOrdenEdit($maquina->id, $request->numero_orden, $tutoriale->numero_orden)){
                        $request->request->add(['video' => $videoName, 'maquina_id' => $maquina->id]);
                        $tutoriale->update($request->all());
                        return redirect("maquinas/$maquina->id/tutoriales/$tutoriale->id")->withErrors($messageBag->add('success','El tuturial ha sido modificado en la aplicación con exito.'));
                    }
                }
            }else{
                if(Tutoriale::setNumeroOrdenEdit($maquina->id, $request->numero_orden, $tutoriale->numero_orden)){
                    $request->request->add(['video' => $tutoriale->video, 'maquina_id' => $maquina->id]);
                    $tutoriale->update($request->all());
                    return redirect("maquinas/$maquina->id/tutoriales/$tutoriale->id")->withErrors($messageBag->add('success','El tuturial ha sido modificado en la aplicación con exito.'));
                }
            }
        }
        return back()->withErrors($messageBag->add('error', 'No se puede modificar este tutorial en la BD, intente de nuevo.'));
    }

    /**
     * Remove the specified Tutorial from storage.
     *
     * @param  \App\Maquina $maquina
     * @param  \App\Tutoriale $tutoriale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maquina $maquina, Tutoriale $tutoriale)
    {
        $messageBag = new MessageBag;
        if($maquina->id == $tutoriale->maquina_id){
            if(Tutoriale::deleteTutorial($tutoriale->video) && Tutoriale::updateOrdenDecrease($maquina->id,false,$tutoriale->numero_orden)){
                $tutoriale->delete();
                return redirect("maquinas/$maquina->id/tutoriales")->withErrors($messageBag->add('success', 'El tutorial fue eliminado exitosamente de la aplicación.'));
            }
        }
        return back()->withErrors($messageBag->add('error', 'No se puede eliminar este tutorial de la aplicación.'));
    }
}
