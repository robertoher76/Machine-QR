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
        <h1 class="text-body">Galería de {{ $maquina->nombre_maquina }}</h1>        
        <p class="lead text-muted">Seleccione una imagen de la galería para establecerla como imagen de perfil de {{ $maquina->nombre_maquina }}.</p>                
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
                        <a class="example-image-link" data-title="{{ $maquina->nombre_maquina }}" href="{{ asset('storage/imagenes/galeria/' . $imagen->imagen) }}" data-lightbox="example-1"><img  class="example-image rounded-top w-100" src="{{ asset('storage/imagenes/galeria/' . $imagen->imagen) }}"/></a>                                                                        
                        <div class="card-body text-center">
                            @include('..layouts.modalSelect', ['imagen' => $imagen->imagen, 'id' => $imagen->id])
                            <button type="submit" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#exampleModalCenter{{ $imagen->id }}">Seleccionar</button>                            
                        </div>
                    </div>
                </div> 
                @endforeach
            </div>
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
        <div class="mt-3">
            <a href="{{ route('maquinas.show', $maquina) }}"><i class="fas fa-chevron-left"></i>&nbsp; Regresar</a>
        </div>        
    </div>
@endsection