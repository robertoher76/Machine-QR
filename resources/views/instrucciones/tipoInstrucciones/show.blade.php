@extends('..layouts.plantilla')

@section('cabecera')
    <div class="container mt-5">
        <h1>{{ $tipo->nombre }} &nbsp;
            <a href="{{ Request::url() }}/edit" class="btn btn-outline-success btn-sm"><i class="far fa-edit"></i> Modificar</a>
            <a href="" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Eliminar</a>
        </h1>
        <small class="form-text text-muted">Última Modificación {{ $tipo->updated_at->format('d-m-Y') }}</small>
        <br/>
        <p class="lead">{{ $tipo->descripcion_tipo }}</p>
    </div>
@endsection

@section('contenido')
    <div class="container mt-5 text-center">
        <p>
            <a href="{{ Request::root() }}/instrucciones/tipo">Regresar a tipo de instrucciones</a>
        </p>
    </div>
@endsection