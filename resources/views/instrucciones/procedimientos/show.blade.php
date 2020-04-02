@extends('..layouts.plantilla')

@push('css')
<link rel="stylesheet" href = "{{ asset('css/lightbox.min.css') }}" />
@endpush

@push('js')
<script src="{{ asset('js/lightbox-plus-jquery.min.js') }}"></script>
<script src="{{ asset('js/lightbox-config.js') }}"></script>
@endpush

@section('cabecera')    
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <h2>Procedimiento #{{ $procedimiento->numero_orden }} &nbsp;
                    <a href="{{ Request::url() }}/edit" class="btn btn-outline-success btn-sm"><i class="far fa-edit"></i> Modificar</a>
                    <a href="" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Eliminar</a>
                </h2>
                <small class="form-text text-muted">Última Modificación {{ $procedimiento->updated_at->format('d-m-Y') }}</small>
                <p class="lead">{{ $procedimiento->descripcion }}</p>
            </div>                

            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 align-self-center text-center pr-0">                
                <a id="imagenC" class="example-image-link" data-title="Imagen del procedimiento #{{ $procedimiento->numero_orden }}" href="{{ asset('storage/imagenes/procedimientos/'. $procedimiento->imagen) }}" data-lightbox="example-1"><img class="example-image ml-1 mr-1" style="border-radius: 2%;" widht="100%;" height="225px;" src="{{ asset('storage/imagenes/procedimientos/'. $procedimiento->imagen) }}"/></a>                                        
                <small for="imagenC" class="form-text text-muted">Click sobre la imagen para ampliarla.</small>
            </div>
        </div>
    </div>
@endsection