@extends('..layouts.plantilla')



@section('cabecera')
<div class="container mt-5">
<h2 style="color: black;">Listado de Máquinas &nbsp;<a href="{{ Request::url() }}/create" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Agregar Máquina</a></h2>
<p class="text-muted">Número de Máquinas Registradas: {{ $maquinas->count() }}</p>

</div>
@endsection


@section('contenido')

<div class="album mt-4">
    <div class="container">
    <!--
    <form class="form-inline justify-content-end">
      <div class="form-group mx-sm-3 mb-2">        
        <input type="password" class="form-control form-control-sm" id="inputPassword2" placeholder="Buscar Máquina">
      </div>
      <button type="submit" class="btn btn-primary mb-2 btn-sm">Confirm identity</button>
    </form>
    -->
      <div class="row mt-4">

        @foreach ($maquinas as $maquina)
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
                      
              <img width="100%" height="225" src="{{ asset('storage/imagenes/maquinas/'. $maquina->imagen) }}"/>

            <div class="card-body">
              <h4 class="card-title">{{ $maquina->nombre_maquina }}</h4>
              <p class="card-text">{{ $maquina->descripcion }}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="maquinas/{{ $maquina->id }}" class="btn btn-sm btn-outline-secondary">Ver más</a>
                  <a href="maquinas/{{ $maquina->id }}/edit" class="btn btn-sm btn-outline-secondary">Modificar</a>
                </div>
                <small class="text-muted">Modificado {{ $maquina->updated_at->format('d-m-Y') }}</small>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        

      </div>
      @if($maquinas->lastPage() > 1)                 
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <li class="page-item {{ ($maquinas->onFirstPage()) ? ' disabled' : '' }}">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
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
            <a class="page-link" href="#" aria-disabled="page-link">Siguiente</a>
          </li>          
        </ul>
      </nav>
      @endif      
    </div>
  </div>


@endsection