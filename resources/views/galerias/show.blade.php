@extends('..layouts.plantilla')

@push('css')
<link rel="stylesheet" href = "{{ asset('css/carousel.css') }}" />
    <link rel="stylesheet" href = "{{ asset('css/lightbox.min.css') }}" />
    <link rel="stylesheet" href = "{{ asset('css/show.css') }}" />
@endpush

@push('js')
<script src="{{ asset('js/lightbox-plus-jquery.min.js') }}"></script>
<script src="{{ asset('js/lightbox-config.js') }}"></script>
@endpush

@section('cabecera')
    <div class="container mt-sm-0 mt-md-3 mt-lg-5 mt-xl-5">
        @if($errors->has('error'))
            @include('..layouts.toastDanger', ['title' => 'Advertencia', 'error' => $errors->first('error')])
        @elseif($errors->has('success'))
            @include('..layouts.toastSuccess', ['title' => 'Exitosamente', 'success' => $errors->first('success')])
        @endif
        <h2 class="text-body d-flex flex-wrap">Imagen de {{ $maquina->nombre_maquina }} &nbsp;
            <td>
                <form method="POST" action="{{ route('galeria.destroy', $galeria) }}">
                    <a href="{{ route('galeria.edit', $galeria) }}" class="btn btn-outline-success btn-sm"><i class="far fa-edit"></i> Modificar</a>
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-outline-danger btn-sm" type="submit"><i class="far fa-trash-alt"></i> Eliminar</button>
                </form>
            </td>
        </h2>
        <p style="font-size: 19px;" class="lead text-justify mt-1">{{ $galeria->descripcion}}</p>
    </div>
@endsection

@section('contenido')
    <div class="container w-50 text-center">
        <a class="example-image-link" data-title="{{ $maquina->nombre_maquina }}" href="{{ asset('storage/imagenes/galeria/' . $galeria->imagen) }}" data-lightbox="example-1"><img  class="example-image mt-3 rounded w-75 h-75" src="{{ asset('storage/imagenes/galeria/' . $galeria->imagen) }}"/></a>        
        <small class="form-text text-muted">Click sobre la imagen para ampliarla.</small>
    </div>
    <div class="container mt-5">
        <a href="{{ route('maquinas.galeria.index', $maquina) }}"><i class="fas fa-chevron-left"></i>&nbsp; Regresar</a>
    </div> 
@endsection