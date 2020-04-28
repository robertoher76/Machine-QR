<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTipoInstruccionRequest;
use App\Instrucciones_tipo;
use App\Maquina;

class InstruccionTipoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instruccionesTipo = Instrucciones_tipo::paginate(15);
        return view('instrucciones.tipoInstrucciones.index', ['instruccionesTipo' => $instruccionesTipo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('instrucciones.tipoInstrucciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateTipoInstruccionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTipoInstruccionRequest $request)
    {
        Instrucciones_tipo::create($request->all());

        return redirect('instrucciones/tipo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Instrucciones_tipo  $tipo
     * @return \Illuminate\Http\Response
     */
    public function show(Instrucciones_tipo $tipo)
    {
        return view('instrucciones.tipoInstrucciones.show', compact('tipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Instrucciones_tipo  $tipo
     * @return \Illuminate\Http\Response
     */
    public function edit(Instrucciones_tipo $tipo)
    {
        return view('instrucciones.tipoInstrucciones.edit', compact('tipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CreateTipoInstruccionRequest  $request
     * @param  \App\Instrucciones_tipo  $tipo
     * @return \Illuminate\Http\Response
     */
    public function update(CreateTipoInstruccionRequest $request, Instrucciones_tipo $tipo)
    {
        $tipo->update($request->all());
        return redirect('instrucciones/tipo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Instrucciones_tipo  $tipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instrucciones_tipo  $tipo)
    {
        //
    }
}
