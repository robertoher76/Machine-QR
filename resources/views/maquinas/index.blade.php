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
    <h2 style="color: black;">Lista de Máquinas &nbsp;<a href="{{ Request::url() }}/create" class="btn btn-outline-success btn-sm"><i class="fas fa-plus"></i> Agregar Máquina</a></h2>
    <p class="text-muted">Total Máquinas: <span class="font-weight-bold">{{ $maquinas->total() }}</span></p>
</div>
@endsection

@section('contenido')

<div class="album">
    <div class="container">
      <div class="row">

        @foreach ($maquinas as $maquina)
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 d-flex align-items-stretch">
          <div class="card mb-4 shadow-sm">
            <div>
            <a class="example-image-link" data-title="{{ $maquina->nombre_maquina }}" href="{{ asset('storage/imagenes/maquinas/'. $maquina->imagen) }}" data-lightbox="example-1"><img class="example-image" style="border-radius: 2%;width:100%;" widht="100%" height="225" src="{{ asset('storage/imagenes/maquinas/'. $maquina->imagen) }}"/></a>
            </div>
            <div class="card-body">
              <h4 class="card-title">{{ $maquina->nombre_maquina }}</h4>
              <p class="card-text">{{ $maquina->descripcion }}</p>
            </div>
            <div class="card-footer" style="background: white !important;border-top: 0 !important;">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="{{ Request::url() }}/{{ $maquina->id }}" class="btn btn-sm btn-outline-secondary">Ver más</a>
                  <a href="maquinas/{{ $maquina->id }}/edit" class="btn btn-sm btn-outline-secondary">Modificar</a>
                </div>
                <small class="text-muted">Modificado {{ $maquina->updated_at->format('d-m-Y') }}</small>
              </div>
            </div>
          </div>
        </div>
        @endforeach


      </div>

      <br/><br/>
      @if($maquinas->lastPage() > 1)
        <!--<div class="text-center">
          <small class="text-muted">Máquina {{ $maquinas->firstItem() }} a la {{ $maquinas->lastItem() }}</small>
        </div>-->
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
      @endif
      <br/><br/>
    </div>
  </div>


@endsection
