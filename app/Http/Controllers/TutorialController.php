<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTutorialRequest;
use App\Http\Requests\EditTutorialRequest;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use App\Tutoriale;
use App\Maquina;

class TutorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Maquina $maquina)
    {
        $tutoriales = Tutoriale::where('maquina_id','=',$maquina->id)->paginate(10);
        $tutoriales = Maquina::cortarParrafos($tutoriales, 100);

        return view('tutoriales.index', compact('maquina'), ['tutoriales' => $tutoriales]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Maquina $maquina)
    {
        return view('tutoriales.create', compact('maquina'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTutorialRequest $request, Maquina $maquina)
    {
        if($videoName = Tutoriale::setTutorialMaquina($request->video_up)){
            $ultimoTutorial = Tutoriale::where('maquina_id','=',$maquina->id)                                            
                                            ->orderBy('numero_orden','desc')
                                            ->value('numero_orden');

            $request->request->add(['video' => $videoName, 'maquina_id' => $maquina->id, 'numero_orden' => $ultimoTutorial + 1]);

            Tutoriale::create($request->all());

            return redirect('/maquinas/'.$maquina->id.'/tutoriales');
        }
        $messageBag = new MessageBag;
        return back()->withErrors($messageBag->add('video_up', 'Error al subir el video a la base de datos, intente de nuevo'))->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Maquina $maquina, Tutoriale $tutoriale)
    {
        return view('tutoriales.show', compact('maquina'), compact('tutoriale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Maquina $maquina, Tutoriale $tutoriale)
    {
        return view('tutoriales.edit', compact('maquina'), compact('tutoriale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditTutorialRequest $request, Maquina $maquina, Tutoriale $tutoriale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
