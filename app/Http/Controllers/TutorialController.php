<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTutorialRequest;
use App\Http\Requests\EditTutorialRequest;
use Illuminate\Support\MessageBag;
use App\Tutoriale;
use App\Maquina;

class TutorialController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

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
                $tutorial = Tutoriale::create($request->all());
                return redirect("tutoriales/$tutorial->id")->withErrors($messageBag->add('success', "$tutorial->titulo fue añdadido en la aplicación con éxito."));
            }
        }
        return back()->withErrors($messageBag->add('error', 'Error al subir el video a la base de datos, intente de nuevo'));
    }

    /**
     * Display the specified Tutorial.
     *
     * @param  \App\Tutoriale $tutoriale
     * @return \Illuminate\Http\Response
     */
    public function show(Tutoriale $tutoriale)
    {
        return view('tutoriales.show', ['tutoriale' => $tutoriale, 'maquina' => Maquina::find($tutoriale->maquina_id)]);
    }

    /**
     * Show the form for editing the specified Tutorial.
     *
     * @param  \App\Tutoriale $tutoriale
     * @return \Illuminate\Http\Response
     */
    public function edit(Tutoriale $tutoriale)
    {
        return view('tutoriales.edit', ['tutoriale' => $tutoriale, 'maquina' => Maquina::find($tutoriale->maquina_id), 'lists' => Tutoriale::getTutoriales($tutoriale->maquina_id)]);
    }

    /**
     * Update the specified Tutorial in storage.
     *
     * @param  \App\Http\Requests\EditTutorialRequest  $request
     * @param  \App\Tutoriale $tutoriale
     * @return \Illuminate\Http\Response
     */
    public function update(EditTutorialRequest $request, Tutoriale $tutoriale)
    {
        $messageBag = new MessageBag;        
        if($request->cambiarImagen){
            $request->validate([
                'video_up' => 'required|mimes:jpg,jpeg,png|max:500000'],[
                'video_up.required' => 'El video tutorial es requerido.',
                'video_up.mimes' => 'El video tutorial debe ser un tipo de archivo: mp4.',
                'video_up.max' => 'El video no debe ser mayor a 500000 kilobytes.'
            ]);
            if($videoName = Tutoriale::setTutorialMaquina($request->video_up, $tutoriale->video))              
                $request->request->add(['video' => $videoName]);                                    
        }
        if(Tutoriale::setNumeroOrdenEdit($tutoriale->maquina_id, $request->numero_orden, $tutoriale->numero_orden)){            
            $tutoriale->update($request->all());
            return redirect("tutoriales/$tutoriale->id")->withErrors($messageBag->add('success', "$tutoriale->titulo ha sido modificado en la aplicación con éxito."));
        }        
        return back()->withErrors($messageBag->add('error', 'No se puede modificar este tutorial en la BD, intente de nuevo.'));
    }

    /**
     * Remove the specified Tutorial from storage.
     *
     * @param  \App\Tutoriale $tutoriale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tutoriale $tutoriale)
    {
        $messageBag = new MessageBag;
        if(Tutoriale::deleteTutorial($tutoriale->video) && Tutoriale::updateOrdenDecrease($tutoriale->maquina_id,false,$tutoriale->numero_orden)){
            $id = $tutoriale->maquina_id;
            $tutoriale->delete();
            return redirect("maquinas/$id/tutoriales")->withErrors($messageBag->add('success', 'El tutorial fue eliminado de la aplicación con éxito.'));
        }
        return back()->withErrors($messageBag->add('error', 'No se puede eliminar este tutorial de la aplicación.'));
    }
}
