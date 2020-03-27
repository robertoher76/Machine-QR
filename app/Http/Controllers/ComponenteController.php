<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateComponenteRequest;
use App\Http\Requests\EditComponenteRequest;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use App\Componente;
use App\Maquina;

class ComponenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Maquina $maquina)
    {
        $componentes = Componente::where('maquina_id','=',$maquina->id)->paginate(15);
        $componentes = Maquina::cortarParrafos($componentes, 100); 

        return view('componentes.index', compact('maquina'), ['componentes' => $componentes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Maquina $maquina)
    {                
        return view('componentes.create', compact('maquina'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateComponenteRequest $request, Maquina $maquina)
    {
        if($request->maquina_id == $maquina->id){            
            if($imagenName = Componente::setImagenComponente($request->foto_up)){
                $ultimoComponente = Componente::where('maquina_id','=',$maquina->id)                                            
                                            ->orderBy('numero_orden','desc')
                                            ->value('numero_orden');

                $request->request->add(['imagen' => $imagenName, 'numero_orden' => $ultimoComponente + 1]);
                Componente::create($request->all());

                return redirect('/maquinas/'.$maquina->id);
            }
            $messageBag = new MessageBag;
            return back()->withErrors($messageBag->add('imagen', 'Error al subir la imagen a la base de datos, intente de nuevo'))->withInput();
        }
        $messageBag = new MessageBag;
        return back()->withErrors($messageBag->add('error', 'No modifique la ruta o los inputs ocultos pedazo de gonorrea culio'))->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Maquina $maquina, Componente $componente)
    {        
        if($componente->maquina_id == $maquina->id){
            return view('componentes.show', compact('maquina'), compact('componente'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Maquina $maquina, Componente $componente)
    {
        return view('componentes.edit', compact('maquina'), compact('componente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditComponenteRequest $request, Maquina $maquina, Componente $componente)
    {
        if($request->maquina_id == $maquina->id){              
            if($request->cambiarImagen){

                $request->validate([
                    'foto_up' => 'required|mimes:jpg,jpeg,png|max:2500',
                ], [
                    'foto_up.required' => 'La imagen del componente es requerido.',
                    'foto_up.mimes' => 'La imagen debe ser un tipo de archivo: jpg, jpeg, png.',
                    'foto_up.max' => 'La imagen no debe ser mayor a 2500 kilobytes.',
                ]);    

                if($imagenName = Componente::setImagenComponente($request->foto_up, $componente->imagen)){
                    $request->request->add(['imagen' => $imagenName]);

                    $componente->update($request->all());

                    return redirect('/maquinas/'.$maquina->id);
                }
                $messageBag = new MessageBag;
                return back()->withErrors($messageBag->add('imagen', 'Error al subir la imagen a la base de datos, intente de nuevo'))->withInput();
            }     
            
            $request->request->add(['imagen' => $componente->imagen]);

            $componente->update($request->all());

            return redirect('/maquinas/'.$maquina->id);

        }
        $messageBag = new MessageBag;
        return back()->withErrors($messageBag->add('error', 'No modifique la ruta o los inputs ocultos pedazo de gonorrea culio'))->withInput();
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
