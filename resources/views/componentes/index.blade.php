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
    <h2 style="color: black;">Componentes de {{ $maquina->nombre_maquina }} &nbsp;<a href="{{ Request::url() }}/create" class="btn btn-outline-success btn-sm"><i class="fas fa-plus"></i> Agregar Máquina</a></h2>
    <p class="text-muted">Total Componentes: <span class="font-weight-bold">{{ $componentes->total() }}</span></p>
</div>
@endsection


@section('contenido')

<div class="album">
    <div class="container">    
      <div class="row">

        @foreach ($componentes as $componente)
          <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 d-flex align-items-stretch">
            <div class="card mb-4 shadow-sm">                                
              <div>
                  <a class="example-image-link" data-title="{{ $componente->nombre }}" href="{{ asset('storage/imagenes/componentes/'. $componente->imagen) }}" data-lightbox="example-1"><img class="example-image" style="border-radius: 2%;width:100%;" widht="100%" height="225" src="{{ asset('storage/imagenes/componentes/'. $componente->imagen) }}"/></a>
              </div>
              <div class="card-body">
                <h4 class="card-title">{{ $componente->nombre }}</h4>
                <p class="card-text">{{ $componente->descripcion }}</p>                             
              </div>
              <div class="card-footer" style="background: white !important;border-top: 0 !important;"> 
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <a href="{{ Request::url() }}/{{ $componente->id }}" class="btn btn-sm btn-outline-secondary">Ver más</a>
                    <a href="maquinas/{{ $componente->id }}/edit" class="btn btn-sm btn-outline-secondary">Modificar</a>
                  </div>
                  <small class="text-muted ml-3">Modificado {{ $componente->updated_at->format('d-m-Y') }}</small>
                </div> 
              </div>
            </div>
          </div>
        @endforeach
        

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

    </div>
  </div>


@endsection