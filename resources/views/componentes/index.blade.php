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
    <h1 style="color: black;">Componentes de {{ $maquina->nombre_maquina }} &nbsp;<a href="{{ Request::url() }}/create" class="btn btn-outline-success btn-sm"><i class="fas fa-plus"></i> Agregar</a></h1>
    @if($componentes->count() > 0)
        <p class="text-dark">Total Componentes: <span class="font-weight-bold">{{ $componentes->count() }}</span></p>
    @endif
</div>
@endsection


@section('contenido')
<div class="album">
    <div class="container mt-4">
        @if($errors->has('error'))
            @include('..layouts.toastDanger', ['title' => 'Advertencia', 'error' => $errors->first('error')])
        @elseif($errors->has('success'))
            @include('..layouts.toastSuccess', ['title' => 'Exitosamente', 'success' => $errors->first('success')])
        @endif
        <div class="row mt-4">
            @if($componentes->count() > 0)
                @foreach ($componentes as $componente)
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 d-flex align-items-stretch">
                        <div class="card mb-4 shadow-sm">
                            <div>
                                <a class="example-image-link" data-title="{{ $componente->nombre }}" href="{{ asset('storage/imagenes/componentes/'. $componente->imagen) }}" data-lightbox="example-{{ $componente->id }}"><img class="example-image" style="border-radius: 1%;width:100%;" widht="100%" height="255" src="{{ asset('storage/imagenes/componentes/'. $componente->imagen) }}"/></a>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">{{ $componente->nombre }}</h4>
                                <p class="card-text">{{ $componente->descripcion }}</p>
                            </div>
                            <div class="card-footer" style="background: white !important;border-top: 0 !important;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ Request::url() }}/{{ $componente->id }}" class="btn btn-sm btn-outline-secondary">Ver más</a>
                                        <a href="componente/{{ $componente->id }}/edit" class="btn btn-sm btn-outline-secondary">Modificar</a>
                                    </div>
                                    <small class="text-muted ml-3">Modificado {{ $componente->updated_at->format('d-m-Y') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="container mt-3 mb-5 text-center">
                    <div class="display-1 mt-sm-1 mt-md-4 mt-lg-4 mt-xl-4">
                        <div class="display-1 text-center">
                            <i class="far fa-folder-open"></i>
                        </div>
                        <div class="display-1 text-center">
                            <h4>No posee Componentes</h4>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <br/><br/>
        @if($componentes->lastPage() > 1)
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item {{ ($componentes->onFirstPage()) ? ' disabled' : '' }}">
                        <a class="page-link" href="{{ $componentes->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Anterior</a>
                    </li>
                    @for ($i = 1; $i <= $componentes->lastPage(); $i++)
                        <li class="page-item {{ ($componentes->currentPage() == $i) ? ' active' : '' }}">
                            @if($componentes->currentPage() != $i)
                                <a class="page-link" href="{{ $componentes->url($i) }}">
                                    {{ $i }}
                                </a>
                            @else
                                <span class="page-link">
                                    {{ $i }}
                                    <span class="sr-only">(current)</span>
                                </span>
                            @endif
                        </li>
                    @endfor
                    <li class="page-item {{ ($componentes->currentPage() == $componentes->lastPage()) ? ' disabled' : '' }}">
                        <a class="page-link" href="{{ $componentes->nextPageUrl() }}" aria-disabled="page-link">Siguiente</a>
                    </li>
                </ul>
            </nav>
            <br/>
        @endif
        <div class="mt-2">
            <a href="{{ Request::root() }}/maquinas/{{$maquina->id}}"><i class="fas fa-chevron-left"></i>&nbsp; Regresar</a>
        </div>
    </div>
</div>
@endsection
