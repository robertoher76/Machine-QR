@extends('..layouts.plantilla')

@section('cabecera')
<div class="container mt-sm-0 mt-md-3 mt-lg-5 mt-xl-5">
    <h2 class="text-body">Instrucciones de {{ $maquina->nombre_maquina }} &nbsp;<a href="{{ route('maquinas.instrucciones.create', $maquina) }}" class="btn btn-outline-success btn-sm"><i class="far fa-plus-square"></i> Agregar</a></h2>
    @if($instrucciones->total() > 0)
        <p class="text-body">Total Máquinas: <span class="font-weight-bold">{{ $instrucciones->total() }}</span></p>
    @endif
</div>
@endsection

@section('contenido')
    <div class="container">
        @if($errors->has('error'))
            @include('..layouts.toastDanger', ['title' => 'Advertencia', 'error' => $errors->first('error')])
        @elseif($errors->has('success'))
            @include('..layouts.toastSuccess', ['title' => 'Exitosamente', 'success' => $errors->first('success')])
        @endif
        
        @if($instrucciones->total() > 0)
            @foreach ($instrucciones as $instruccion)
                <div class="card mt-4 mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-dark">{{ $instruccion->titulo }} <small class="text-muted">&nbsp; Última Modificación {{ $instruccion->updated_at->format('d-m-Y') }}</small></h5>
                        <p class="card-text">{{ $instruccion->descripcion }}</p>
                        <a href="{{ route('instrucciones.show', $instruccion) }}" class="btn btn-primary btn-sm">Ver más</a>
                    </div>
                    <div class="card-footer">
                        Tipo de Instrucción: <a href="{{ route('tipo.show', $instruccion->instrucciones_tipo_id) }}">{{ $instruccion->nombre }}</a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="container mt-5 mb-7 text-center">
                <div class="display-1 mt-sm-1 mt-md-4 mt-lg-4 mt-xl-4">
                    <div class="display-1 text-center">
                        <i class="far fa-folder-open"></i>
                    </div>
                    <div class="display-1 text-center">
                        <h4>No posee Instrucciones</h4>
                    </div>
                </div>
            </div>
        @endif

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item {{ ($instrucciones->onFirstPage()) ? ' disabled' : '' }}">
                        <a class="page-link" href="{{ $instrucciones->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Anterior</a>
                    </li>
                    @for ($i = 1; $i <= $instrucciones->lastPage(); $i++)
                        <li class="page-item {{ ($instrucciones->currentPage() == $i) ? ' active' : '' }}">
                            @if($instrucciones->currentPage() != $i)
                                <a class="page-link" href="{{ $instrucciones->url($i) }}">
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
                    <li class="page-item {{ ($instrucciones->currentPage() == $instrucciones->lastPage()) ? ' disabled' : '' }}">
                        <a class="page-link" href="{{ $instrucciones->nextPageUrl() }}" aria-disabled="page-link">Siguiente</a>
                    </li>
                </ul>
            </nav>
        <div class="mt-5">
            <a href="{{ route('maquinas.show', $maquina) }}"><i class="fas fa-chevron-left"></i>&nbsp; Regresar</a>
        </div>
    </div>
@endsection
