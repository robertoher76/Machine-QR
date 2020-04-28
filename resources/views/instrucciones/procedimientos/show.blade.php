@extends('..layouts.plantilla')

@push('css')
<link rel="stylesheet" href = "{{ asset('css/lightbox.min.css') }}" />
@endpush

@push('js')
<script src="{{ asset('js/lightbox-plus-jquery.min.js') }}"></script>
<script src="{{ asset('js/lightbox-config.js') }}"></script>
@endpush

@section('cabecera')
    <div class="container mt-sm-3 mt-md-3 mt-lg-5 mt-xl-5">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <h2 class="d-flex flex-wrap mb-3">Procedimiento #{{ $procedimiento->numero_orden }} &nbsp;
                    <td>
                        <form method="POST" action="{{ route('procedimientos.destroy', $procedimiento) }}">
                            <a href="{{ route('procedimientos.edit', $procedimiento) }}" class="btn btn-outline-success btn-sm"><i class="far fa-edit"></i> Modificar</a>
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-outline-danger btn-sm" type="submit"><i class="far fa-trash-alt"></i> Eliminar</button>
                        </form>
                    </td>
                </h2>
                <small class="form-text text-muted mb-2">Procedimiento de <a href="{{ route('instrucciones.show', $instruccione) }}">{{$instruccione->titulo}}</a> | Última Modificación {{ $procedimiento->updated_at->format('d-m-Y') }}</small>
                <p style="font-size: 19px;" class="lead">{{ $procedimiento->descripcion }}</p>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 align-self-center text-center pr-0 mt-4">
                <a id="imagenC" class="example-image-link" data-title="Imagen del procedimiento #{{ $procedimiento->numero_orden }}" href="{{ asset('storage/imagenes/procedimientos/'. $procedimiento->imagen) }}" data-lightbox="example-1"><img class="example-image ml-1 mr-1 rounded" height="225px;" src="{{ asset('storage/imagenes/procedimientos/'. $procedimiento->imagen) }}"/></a>
                <small for="imagenC" class="form-text text-muted">Click sobre la imagen para ampliarla.</small>
            </div>
        </div>
        <div class="mt-5">
            <a href="{{ route('instrucciones.show', $instruccione) }}"><i class="fas fa-chevron-left"></i>&nbsp; Regresar</a>
        </div>
    </div>
@endsection
