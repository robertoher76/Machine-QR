@extends('..layouts.plantilla')

@push('css')
    <link rel="stylesheet" href = "{{ asset('css/show.css') }}" />
@endpush

@section('cabecera')
    <div class="container mt-5">

        <h1>{{ $tutoriale->titulo }} &nbsp;
            <a href="{{ Request::url() }}/edit" class="btn btn-outline-success btn-sm"><i class="far fa-edit"></i> Modificar</a>
            <a href="{{ Request::url() }}/edit" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Eliminar</a>
        </h1>
        <small class="form-text text-muted">Tutorial de {{ $maquina->nombre_maquina }} | Última Modificación {{ $tutoriale->updated_at->format('d-m-Y') }}</small>
        <br/>
        <p style="font-size: 18px;" class="lead">{{ $tutoriale->descripcion}}</p>
        <br/>
    </div>
@endsection

@section('contenido')
    <div class="container ">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mx-auto">
            <video  src="{{ asset('storage/tutoriales/' . $tutoriale->video) }}" controls>
                Tu navegador no implementa el elemento <code>video</code>.
            </video>
        </div>
    </div>
    <div class="container mt-5 text-center">
        <p>
            <a href="{{ Request::root() }}/maquinas/{{$maquina->id}}">Regresar a {{ $maquina->nombre_maquina}}</a>
        </p>
    </div>
@endsection
