<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMaquinaRequest;
use App\Http\Requests\EditMaquinaRequest;
use Illuminate\Http\Request;
use App\Maquina_imagene;
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
        $maquinas = Maquina::paginate(15);

        foreach ($maquinas as $maquina) {
            $maquina->descripcion = substr($maquina->descripcion, 0, 80) . '...';
        }

        return view('maquinas.index', ['maquinas' => $maquinas]);
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
        if($imagenName = Maquina::setImagenMaquina($request->foto_up)){
            $request->request->add(['imagen' => $imagenName]);

            if($qrName = Maquina::setQRMaquina())
                $request->request->add(['codigo_qr' => $qrName]);

            Maquina::create($request->all());

            return redirect('/maquinas');
        }

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
    public function update(EditMaquinaRequest $request, $id)
    {
        $maquina = Maquina::findOrFail($id);
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
            ]
            
            );

                        
            
            if($imagenName = Maquina::setImagenMaquina($request->foto_up, $maquina->imagen)){
                $request->request->add(['imagen' => $imagenName]);
                $request->request->add(['codigo_qr' => $maquina->codigo_qr]);                    
    
                $maquina->update($request->all());
    
                return redirect('/maquinas');
            }

        }else{
            $request->request->add(['imagen' => $maquina->imagen]);
            $request->request->add(['codigo_qr' => $maquina->codigo_qr]); 

            $maquina->update($request->all());
    
            return redirect('/maquinas');
        }
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
