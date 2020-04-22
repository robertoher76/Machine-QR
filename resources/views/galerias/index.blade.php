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
<div class="container mt-sm-1 mt-md-2 mt-lg-2 mt-xl-2">
    @if($errors->has('error'))
        @include('..layouts.toastDanger', ['title' => 'Advertencia', 'error' => $errors->first('error')])
    @elseif($errors->has('success'))
        @include('..layouts.toastSuccess', ['title' => 'Exitosamente', 'success' => $errors->first('success')])
    @endif
    <section class="jumbotron bg-transparent text-center">        
        <h1>Galería de {{ $maquina->nombre_maquina }}</h1>
        <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>        
        <p>
            <a href="{{ Request::url() }}/create" class="btn btn-outline-success my-2"><i class="far fa-plus-square"></i> Añadir imagen</a>            
        </p>
  </section>
</div>
@endsection

@section('contenido')
    <div class="container">
        @if($imagenes->count() > 0)     
            <div class="row" style="margin-top: -6% !important;margin-bottom: 5% !important;">                       
                @foreach($imagenes as $imagen)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">                    
                        <a class="example-image-link" data-title="{{ $maquina->nombre_maquina }}" href="{{ asset('storage/imagenes/galeria/' . $imagen->imagen) }}" data-lightbox="example-1"><img  class="example-image" style="border-radius: 1%;width:100%;" widht="100%" height="100%" src="{{ asset('storage/imagenes/galeria/' . $imagen->imagen) }}"/></a>
                        <div class="card-body">
                            <p class="card-text text-justify">{{ $imagen->descripcion }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{ Request::url() }}/{{ $imagen->id }}" class="btn btn-sm btn-outline-secondary">Ver más</a>
                                    <a href="{{ Request::url() }}/{{ $imagen->id }}/edit" class="btn btn-sm btn-outline-secondary">Modificar</a>
                                </div>   
                                <small class="text-muted">Modificado {{ $imagen->updated_at->format('d-m-Y') }}</small>                         
                            </div>
                        </div>
                    </div>
                </div> 
                @endforeach
            </div>
            @if($imagenes->lastPage() > 1)
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item {{ ($imagenes->onFirstPage()) ? ' disabled' : '' }}">
                            <a class="page-link" href="{{ $imagenes->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Anterior</a>
                        </li>
                        @for ($i = 1; $i <= $imagenes->lastPage(); $i++)
                            <li class="page-item {{ ($imagenes->currentPage() == $i) ? ' active' : '' }}">
                                @if($imagenes->currentPage() != $i)
                                    <a class="page-link" href="{{ $imagenes->url($i) }}">
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
                        <li class="page-item {{ ($imagenes->currentPage() == $imagenes->lastPage()) ? ' disabled' : '' }}">
                            <a class="page-link" href="{{ $imagenes->nextPageUrl() }}" aria-disabled="page-link">Siguiente</a>
                        </li>
                    </ul>
                </nav>
                <br/>

            @endif

        @else
            <div class="text-center" style="margin-top: -8% !important;margin-bottom: 5% !important;">
                <div class="display-1" style="margin-right: -1%;">
                    <div class="display-1 text-center">
                        <i class="far fa-folder-open"></i>
                    </div>
                    <div class="display-1 text-center">
                    <h4>No posee Imagenes</h4>
                    </div>
                </div>
            </div>
        @endif
        <div class="container mt-4">
            <a href="{{ Request::root() }}/maquinas/{{ $maquina->id }}"><i class="fas fa-chevron-left"></i>&nbsp; Regresar</a>
        </div>        
    </div>
@endsection
