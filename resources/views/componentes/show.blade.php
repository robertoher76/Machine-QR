@extends('..layouts.plantilla')

@section('cabecera')
    <div class="container mt-5">
        <div class="row">
            @foreach ($componente as $componente)
            
            <div class="col">
                <h1>{{ $componente->nombre }} &nbsp;<button type="button" class="btn btn-success btn-sm">Editar</button></h1>
                <small class="form-text text-muted">Componente de {{ $componente->nombre_maquina }}</small>
                <br/>
                <p class="lead">{{ $componente->descripcion}}</p>
                <br/>
                <p class="lead">Modificado {{ $componente->updated_at->format('d-m-Y') }}</p>
            </div>
            <div class="col-4 pr-0">
                <img src="{{ asset('imagenes/maquinas/'. $componente->imagen) }}" width="100%;" alt="Responsive image">
            </div>
            @endforeach
        </div>
    </div>
@endsection

@section('contenido')
<div class="container mt-5">
    <div class="container mt-10 text-center">
        <p>
            <a href="{{ Request::root() }}/maquinas/{{ $componente->maquina_id }}">Ir a {{ $componente->nombre_maquina }}</a>
        </p>
    </div>

</div>
@endsection
