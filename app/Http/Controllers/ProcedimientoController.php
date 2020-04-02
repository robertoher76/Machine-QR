<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProcedimientoRequest;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use App\Maquina;
use App\Instruccione;
use App\Procedimiento;

class ProcedimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Instruccione $instruccione)
    {
        $lists = Procedimiento::where('instruccione_id','=',$instruccione->id)
                                ->orderBy('numero_orden')
                                ->get();
        return view('instrucciones.procedimientos.create', ['instruccione' => $instruccione, 'lists' => $lists]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CreateProcedimientoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProcedimientoRequest $request, Instruccione $instruccione)
    {       
        if($request->instruccione_id == $instruccione->id){
            if($imagenName = Procedimiento::setImagenProcedimiento($request->foto_up)){
                if(Procedimiento::setNumero_Orden($request->numero_orden, $instruccione->id)){
                    $request->request->add(['imagen' => $imagenName]);

                    Procedimiento::create($request->all());

                    return redirect('maquinas/instrucciones/'.$instruccione->id);
                }                
            }
        }
        $messageBag = new MessageBag;
        return back()->withErrors($messageBag->add('foto_up', 'Error al subir la imagen a la base de datos, intente de nuevo'))->withInput();        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Instruccione $instruccione, Procedimiento $procedimiento)
    {
        return view('instrucciones.procedimientos.show', ['instruccione' => $instruccione, 'procedimiento' => $procedimiento]);
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
