@extends('..layouts.plantilla')

@push('css')
    <link rel="stylesheet" href = "{{ asset('css/lightbox.min.css') }}" />
@endpush

@push('js')
<script src="{{ asset('js/lightbox-plus-jquery.min.js') }}"></script>
<script src="{{ asset('js/lightbox-config.js') }}"></script>
@endpush

@section('cabecera')
    <div class="container mt-sm-0 mt-md-3 mt-lg-5 mt-xl-5">
        <div class="row">
            <div class="col-12">
                <h2  style="margin-bottom: -2% !important;" class="mb-0 d-flex flex-wrap">{{ $instruccion->titulo }} &nbsp;
                    <td>
                        <form method="POST" action="{{ route('instrucciones.destroy', $instruccion) }}">
                            <a href="{{ route('instrucciones.edit', $instruccion) }}" class="btn btn-outline-success btn-sm"><i class="far fa-edit"></i> Modificar</a>
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-outline-danger btn-sm" type="submit"><i class="far fa-trash-alt"></i> Eliminar</button>
                        </form>
                    </td>
                </h2>
                <small class="form-text text-muted mt-0">Tipo de Instrucción: <a href="{{ route('tipo.show', $tipo->id) }}">{{ $tipo->nombre }}</a> | Modificado {{ $instruccion->updated_at->format('d-m-Y') }}</small>
                <p style="font-size: 19px;" class="lead mt-2">{{ $instruccion->descripcion}}</p>
            </div>
        </div>
    </div>
@endsection

@section('contenido')
<div class="container mt-4">
    @if($errors->has('error'))
        @include('..layouts.toastDanger', ['title' => 'Advertencia', 'error' => $errors->first('error')])
    @elseif($errors->has('success'))
        @include('..layouts.toastSuccess', ['title' => 'Exitosamente', 'success' => $errors->first('success')])
    @endif
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="list-group" id="list-tab" role="tablist">
                @if($procedimientos->count() == 0)
                    <a class="list-group-item list-group-item-action active" id="list-S1-list" data-toggle="list" href="#list-S1" role="tab" aria-controls="S1">Sin Procedimientos</a>
                @endif
                @foreach($procedimientos as $procedimiento)
                    <a class="list-group-item list-group-item-action {{ ($procedimiento->numero_orden == 1) ? 'active' : '' }}" id="list-{{ $procedimiento->numero_orden }}-list" data-toggle="list" href="#list-{{ $procedimiento->numero_orden }}" role="tab" aria-controls="{{ $procedimiento->numero_orden }}">Procedimiento #{{ $procedimiento->numero_orden }}</a>
                @endforeach
                <a id="addProcedimiento" class="list-group-item list-group-item-action " href="{{ route('instrucciones.procedimientos.create', $instruccion) }}"><i id="iconProcedimiento" class="fas fa-plus"></i> Agregar Procedimiento</a>
                <br/>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="tab-content" id="nav-tabContent">
                @if($procedimientos->count() == 0)
                    <div class="tab-pane fade show active" id="list-S1" role="tabpanel" aria-labelledby="list-S1-list">
                         <div class="container mt-2 text-center">
                            <div class="display-1 mt-sm-1 mt-md-4 mt-lg-4 mt-xl-4">
                                <div class="display-1 text-center">
                                    <i class="far fa-folder-open"></i>
                                </div>
                                <div class="display-1 text-center">
                                    <h4>No posee Procedimientos</h4>
                                </div>
                            </div>
                        </div>   
                    </div>
                @endif
                @foreach($procedimientos as $procedimiento)
                    <div class="tab-pane fade {{ ($procedimiento->numero_orden == 1) ? 'show active' : '' }}" id="list-{{ $procedimiento->numero_orden }}" role="tabpanel" aria-labelledby="list-{{ $procedimiento->numero_orden }}-list">
                        <div class="row">
                            <div class="col-12">
                                <h5>{{ $procedimiento->descripcion }}</h5>
                                <p>Modificado {{ $procedimiento->updated_at->format('d-m-Y') }}</p>
                                <td>
                                    <form method="POST" action="{{ route('procedimientos.destroy', $procedimiento) }}">
                                        <a href="{{ route('procedimientos.edit', $procedimiento) }}" class="btn btn-outline-success btn-sm"><i class="far fa-edit"></i> Modificar</a>
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-outline-danger btn-sm" type="submit"><i class="far fa-trash-alt"></i> Eliminar</button>
                                    </form>
                                </td>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="text-center">
                                    <a class="example-image-link" data-title="Procedimiento #{{ $procedimiento->numero_orden }}" href="{{ asset('storage/imagenes/procedimientos/' . $procedimiento->imagen) }}" data-lightbox="example-1"><img class="example-image ml-1 mr-1 rounded" height="200px;" src="{{ asset('storage/imagenes/procedimientos/' . $procedimiento->imagen) }}"/></a>
                                    <small class="form-text text-muted">Click sobre la imagen para ampliarla.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="mt-5">
        <a href="{{ route('maquinas.instrucciones.index', $maquina) }}"><i class="fas fa-chevron-left"></i>&nbsp; Regresar</a>
    </div>
</div>
@endsection

<style>
    #addProcedimiento{
        color: #28a745;
    }
    #addProcedimiento:hover{
        background: #28a745;
        color: white;
    }
</style>
