@extends('..layouts.plantilla')

@section('cabecera')
    <div class="container mt-sm-3 mt-md-3 mt-lg-5 mt-xl-5">
        <div class="row">
            <div class="col-12">
                <h2>{{ Auth::user()->name }} &nbsp;<a href="{{ Request::url() }}/edit" class="btn btn-outline-success btn-sm"><i class="far fa-edit"></i> Modificar</a></h2>
                <h5>robertoher76@gmail.com</h5>                 
            </div>            
        </div>        
    </div>
    <br/>
@endsection

@section('contenido')
    <div class="container mt-sm-5 mt-md-5 mt-lg-7 mt-xl-7">
        <h3 class="text-center mb-5">Lista de Usuarios</h3>        
        <div class="row">
            @foreach($users as $usuario)
            <div class="col-12 row mt-2">
                <div class="col-sm-3 col-lg-4"><h6>{{ $usuario->name }}<h6></div>
                <div class="col-sm-3 col-lg-4 text-center"><h6>{{ $usuario->role->nombre }}</h6></div>
                <div class="col-sm-6 col-lg-4 text-right">
                    <td>
                        <form method="POST" action="{{url('maquinas/')}}">
                            <a href="{{ Request::url() }}/edit" class="btn btn-outline-success btn-sm"><i class="far fa-edit"></i> Modificar</a>
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-outline-primary btn-sm" type="submit"><i class="far fa-eye"></i> Ver más</button>
                        </form>
                    </td>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-5">
            <a href="{{ Request::root() }}/"><i class="fas fa-chevron-left"></i>&nbsp; Regresar</a>
        </div>
    </div>
@endsection