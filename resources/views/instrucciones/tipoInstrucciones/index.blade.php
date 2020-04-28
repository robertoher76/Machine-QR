@extends('..layouts.plantilla')

@section('cabecera')
<div class="container mt-sm-3 mt-md-3 mt-lg-5 mt-xl-5">
    <h2 class="text-body">Tipo de Instrucciones &nbsp;<a href="{{ route('tipo.create') }}" class="btn btn-outline-success btn-sm"><i class="fas fa-plus"></i> Agregar Tipo de Instrucción</a></h2>
    <p class="text-muted">Total Componentes: <span class="font-weight-bold">{{ $instruccionesTipo->total() }}</span></p>
</div>
@endsection

@section('contenido')
<div class="container mt-4">
    @foreach($instruccionesTipo as $tipo)  
    <div class="card mt-3">
        <h5 class="card-header">{{ $tipo->nombre }}</h5>
        <div class="card-body">            
            <p class="card-text">{{ $tipo->descripcion_tipo }}</p>
            <a href="{{ Request::url() }}/{{ $tipo->id }}" class="btn btn-primary btn-sm">Ver más</a>
        </div>
    </div>
    @endforeach

    <br/><br/>             
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">
            <li class="page-item {{ ($instruccionesTipo->onFirstPage()) ? ' disabled' : '' }}">
              <a class="page-link" href="{{ $instruccionesTipo->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Anterior</a>
            </li>
            @for ($i = 1; $i <= $instruccionesTipo->lastPage(); $i++)
              <li class="page-item {{ ($instruccionesTipo->currentPage() == $i) ? ' active' : '' }}">                
                @if($instruccionesTipo->currentPage() != $i)
                  <a class="page-link" href="{{ $instruccionesTipo->url($i) }}">{{ $i }}</a>
                @else
                  <span class="page-link">{{ $i }}<span class="sr-only">(current)</span></span>
                @endif
              </li>
            @endfor
            <li class="page-item {{ ($instruccionesTipo->currentPage() == $instruccionesTipo->lastPage()) ? ' disabled' : '' }}">
              <a class="page-link" href="{{ $instruccionesTipo->nextPageUrl() }}" aria-disabled="page-link">Siguiente</a>
            </li>          
          </ul>
        </nav>
        <br/>
</div>
@endsection