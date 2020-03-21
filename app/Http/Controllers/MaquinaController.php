<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMaquinaRequest;
use Illuminate\Http\Request;
use App\Maquina;
use App\Tutoriale;
use App\Maquina_imagene;

class MaquinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maquinas = Maquina::all();

        foreach ($maquinas as $maquina) {
            $maquina->descripcion = substr($maquina->descripcion, 0, 80) . '...';
        }

        return view('maquinas.index', ['num_maquina' => Maquina::count(), 'maquinas' => $maquinas]);
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
        $maquina = new Maquina;

        $maquina->nombre = $request->nombre;
        $maquina->descripcion = $request->descripcion;
        $maquina->codigo_qr = "codigos/codigo_maquina1.png";

        $maquina->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        
        $componentes = Maquina::find($id)->componentes;

        foreach ($componentes as $componente) {
            
            $componente->descripcion = substr($componente->descripcion, 0, 97) . '...';

        }

        $instrucciones = Maquina::join('instrucciones', 'instrucciones.maquina_id', '=', 'maquinas.id')
                                ->join('instrucciones_tipos','instrucciones_tipos.id','=','instrucciones.instrucciones_tipo_id')
                                ->select('instrucciones_tipos.nombre','instrucciones.*')
                                ->where('maquinas.id','=',$id)                                
                                ->get();                              

        return view('maquinas.show', ['maquina' => Maquina::findOrFail($id), 'componentes' =>  $componentes, 'instrucciones' => $instrucciones, 'tutoriales' => Tutoriale::where('maquina_id','=',$id)->get(), 'galeria' => Maquina_imagene::where('maquina_id','=',$id)->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
