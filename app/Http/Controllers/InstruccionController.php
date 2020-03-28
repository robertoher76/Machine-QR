<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Maquina;
use App\Procedimiento;


class InstruccionController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $instrucciones = Maquina::join('instrucciones', 'instrucciones.maquina_id', '=', 'maquinas.id')
                                ->join('instrucciones_tipos','instrucciones_tipos.id','=','instrucciones.instrucciones_tipo_id')
                                ->select('instrucciones_tipos.nombre','instrucciones.*','maquinas.nombre_maquina','maquinas.id')
                                ->where('instrucciones.id','=',$id)                                
                                ->get();     

        $procedimientos = Procedimiento::where('procedimientos.instruccione_id','=',$id)
                                        ->get();

        return view('instrucciones.show', ['instruccion' => $instrucciones, 'procedimientos' => $procedimientos]);
         
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
