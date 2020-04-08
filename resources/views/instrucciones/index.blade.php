@extends('..layouts.plantilla')

@section('cabecera')
<div class="container mt-5">
    @if($errors->has('error'))
        @include('..layouts.toastDanger', ['title' => 'Advertencia', 'error' => $errors->first('error')])
    @elseif($errors->has('success'))
        @include('..layouts.toastSuccess', ['title' => 'Exitosamente', 'success' => $errors->first('success')])
    @endif
    <h2 style="color: black;">Instrucciones de {{ $maquina->nombre_maquina }} &nbsp;<a href="{{ Request::url() }}/create" class="btn btn-outline-success btn-sm"><i class="fas fa-plus"></i> Agregar Instrucción</a></h2>
    <p class="text-muted">Total Máquinas: <span class="font-weight-bold">{{ $instrucciones->total() }}</span></p>
</div>
@endsection

@section('contenido')
    <div class="container">
        @foreach ($instrucciones as $instruccion)
            <div class="card mt-4 mb-4">
                <div class="card-body">
                    <h5 class="card-title"><a href="instrucciones/{{$instruccion->id}}">{{ $instruccion->titulo }}</a> <small> | Última Modificación {{ $instruccion->updated_at->format('d-m-Y') }}</small></h5>
                    <p class="card-text">{{ $instruccion->descripcion }}</p>
                </div>
                <div class="card-footer">
                    Tipo de Instrucción: {{ $instruccion->nombre }}
                </div>
            </div>
        @endforeach

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
    </div>
    <div class="container mt-5">
        <div class="container mt-10 text-center">
            <p>
                <a href="{{ Request::root() }}/maquinas/{{ $maquina->id }}">Ir a {{ $maquina->nombre_maquina }}</a>
            </p>
        </div>
    </div>
@endsection
