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
        @if($errors->has('error'))
            @include('..layouts.toastDanger', ['title' => 'Advertencia', 'error' => $errors->first('error')])
        @elseif($errors->has('success'))
            @include('..layouts.toastSuccess', ['title' => 'Exitosamente', 'success' => $errors->first('success')])
        @endif

        <br/>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                @include('..layouts.modalDelete')
                <h2>{{ $componente->nombre }} &nbsp;
                    <td>
                        <a href="{{ Request::url() }}/edit" class="btn btn-outline-success btn-sm"><i class="far fa-edit"></i> Modificar</a>
                        <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
                            <i class="far fa-trash-alt"></i> Eliminar
                        </button>
                    </td>
                </h2>
                <small class="form-text text-muted">Componente de {{ $maquina->nombre_maquina }} | Modificado {{ $componente->updated_at->format('d-m-Y') }}</small>
                <p style="font-size: 18px;" class="lead text-justify mt-2">{{ $componente->descripcion}}</p>
                <br/>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 align-self-center text-center pr-0">

                <a id="imagenC" class="example-image-link" data-title="Imagen del Componente {{ $componente->nombre }}" href="{{ asset('storage/imagenes/componentes/'. $componente->imagen) }}" data-lightbox="example-1"><img class="example-image ml-1 mr-1" style="border-radius: 2%;" widht="100%;" height="225px;" src="{{ asset('storage/imagenes/componentes/'. $componente->imagen) }}"/></a>
                <small for="imagenC" class="form-text text-muted">Click sobre la imagen para ampliarla.</small>

            </div>
        </div>
    </div>
@endsection

@section('contenido')
<div class="container mt-5">
    <div class="container mt-10 text-center">
        <p>
            <a href="{{ Request::root() }}/maquinas/{{ $componente->maquina_id }}">Ir a {{ $maquina->nombre_maquina }}</a>
        </p>
    </div>

</div>
@endsection
