@extends('..layouts.plantilla')

@section('cabecera')
<div class="container mt-sm-0 mt-md-3 mt-lg-5 mt-xl-5">
    <h1 style="color: black;">Instrucciones de {{ $maquina->nombre_maquina }} &nbsp;<a href="{{ Request::url() }}/create" class="btn btn-outline-success btn-sm"><i class="fas fa-plus"></i> Agregar</a></h1>
    @if($instrucciones->count() > 0)
        <p class="text-dark">Total Máquinas: <span class="font-weight-bold">{{ $instrucciones->count() }}</span></p>
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
        
        @if($instrucciones->count() > 0)
            @foreach ($instrucciones as $instruccion)
                <div class="card mt-4 mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $instruccion->titulo }} &nbsp; <small class="text-muted"> | &nbsp;&nbsp; Última Modificación {{ $instruccion->updated_at->format('d-m-Y') }}</small></h5>
                        <p class="card-text">{{ $instruccion->descripcion }}</p>
                        <a href="{{Request::url()}}/{{$instruccion->id}}" class="btn btn-primary btn-sm">Ver más</a>
                    </div>
                    <div class="card-footer">
                        Tipo de Instrucción: {{ $instruccion->nombre }}
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

        @if($instrucciones->lastPage() > 1)
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
        @endif
        <div class="mt-5">
            <a href="{{ Request::root() }}/maquinas/{{$maquina->id}}"><i class="fas fa-chevron-left"></i>&nbsp; Regresar</a>
        </div>
    </div>
@endsection
