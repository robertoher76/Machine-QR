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
    <h1 class="text-body">Máquinas 
      @auth 
        &nbsp;<a href="{{ route('maquinas.create') }}" class="btn btn-outline-success btn-sm"><i class="far fa-plus-square"></i> Agregar</a>
      @endauth
    </h1>
    @if($maquinas->total() > 0)
      <p class="text-body">Total Máquinas: <span class="font-weight-bold">{{ $maquinas->total() }}</span></p>
    @endif
</div>
@endsection

@section('contenido')
@if($errors->has('error'))
    @include('..layouts.toastDanger', ['title' => 'Advertencia', 'error' => $errors->first('error')])
@elseif($errors->has('success'))
    @include('..layouts.toastSuccess', ['title' => 'Exitosamente', 'success' => $errors->first('success')])
@endif
<div class="album">
    <div class="container">
      <div class="row">
        @foreach ($maquinas as $maquina)
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 d-flex align-items-stretch">
          <div class="card mb-4 shadow-sm">
            <a class="example-image-link" data-title="{{ $maquina->nombre_maquina }}" href="{{ asset('storage/imagenes/maquinas/'. $maquina->imagen) }}" data-lightbox="example-1"><img  class="example-image rounded w-100" height="250" src="{{ asset('storage/imagenes/maquinas/'. $maquina->imagen) }}"/></a>
            <div class="card-body">
              <h4 class="card-title">{{ $maquina->nombre_maquina }}</h4>
              <p class="card-text text-justify">{{ $maquina->descripcion }}</p>
            </div>
            <div class="card-footer bg-white border-top-0">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="{{ route('maquinas.show', $maquina) }}" class="btn btn-sm btn-outline-secondary">Ver más</a>
                  @auth
                    <a href="{{ route('maquinas.edit', $maquina) }}" class="btn btn-sm btn-outline-secondary">Modificar</a>
                  @endauth
                </div>
                @auth
                  <small class="text-muted">Modificado {{ $maquina->updated_at->format('d-m-Y') }}</small>
                @endauth
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <br/><br/>
      <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">
            <li class="page-item {{ ($maquinas->onFirstPage()) ? ' disabled' : '' }}">
              <a class="page-link" href="{{ $maquinas->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Anterior</a>
            </li>
            @for ($i = 1; $i <= $maquinas->lastPage(); $i++)
              <li class="page-item {{ ($maquinas->currentPage() == $i) ? ' active' : '' }}">
                @if($maquinas->currentPage() != $i)
                  <a class="page-link" href="{{ $maquinas->url($i) }}">
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
            <li class="page-item {{ ($maquinas->currentPage() == $maquinas->lastPage()) ? ' disabled' : '' }}">
              <a class="page-link" href="{{ $maquinas->nextPageUrl() }}" aria-disabled="page-link">Siguiente</a>
            </li>
          </ul>
        </nav>
    </div>
  </div>
@endsection
