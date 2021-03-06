@extends('..layouts.plantilla')

@push('css')
    <link rel="stylesheet" href = "{{ asset('css/show.css') }}" />
@endpush

@section('cabecera')
<div class="container mt-sm-0 mt-md-3 mt-lg-5 mt-xl-5">
    <h2 class="text-body">Tutoriales {{ $maquina->nombre_maquina }} &nbsp;
        @auth
            <a href="{{ route('maquinas.tutoriales.create', $maquina) }}" class="btn btn-outline-success btn-sm"><i class="far fa-plus-square"></i> Agregar</a>
        @endauth
    </h2>
    @if($tutoriales->total() > 0)
        <p class="text-body">Total Tutoriales: {{ $tutoriales->total() }}<span class="font-weight-bold"></span></p>
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
        @if($tutoriales->total() > 0)
            <div class="row">
                @foreach ($tutoriales as $tutorial)
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-1">
                        <div class="card">
                            <div class="card-body">
                                <video  src="{{ asset('storage/tutoriales/' . $tutorial->video) }}" controls>
                                    Tu navegador no implementa el elemento <code>video</code>.
                                </video>
                                <h5 class="card-title mt-2 p-1">{{ $tutorial->titulo }}</h5>
                                <p class="card-text p-1"> {{ $tutorial->descripcion }} </p>
                            </div>
                            <div class="card-footer bg-white border-top-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ route('tutoriales.show', $tutorial) }}" class="btn btn-sm btn-outline-secondary">Ver más</a>
                                        @auth
                                            <a href="{{ route('tutoriales.edit', $tutorial) }}" class="btn btn-sm btn-outline-secondary">Modificar</a>
                                        @endauth
                                    </div>
                                    @auth
                                        <small class="text-muted">Última Modificación {{ $tutorial->updated_at->format('d-m-Y') }}</small>
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
                    <li class="page-item {{ ($tutoriales->onFirstPage()) ? ' disabled' : '' }}">
                    <a class="page-link" href="{{ $tutoriales->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Anterior</a>
                    </li>
                    @for ($i = 1; $i <= $tutoriales->lastPage(); $i++)
                    <li class="page-item {{ ($tutoriales->currentPage() == $i) ? ' active' : '' }}">
                        @if($tutoriales->currentPage() != $i)
                        <a class="page-link" href="{{ $tutoriales->url($i) }}">
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
                    <li class="page-item {{ ($tutoriales->currentPage() == $tutoriales->lastPage()) ? ' disabled' : '' }}">
                    <a class="page-link" href="{{ $tutoriales->nextPageUrl() }}" aria-disabled="page-link">Siguiente</a>
                    </li>
                </ul>
                </nav>            
        @else
            <div class="container mt-5">
                <div class="display-1 mt-sm-1 mt-md-4 mt-lg-4 mt-xl-4">
                    <div class="display-1 text-center">
                        <i class="far fa-folder-open"></i>
                    </div>
                    <div class="display-1 text-center">
                        <h4>No posee Tutoriales</h4>
                    </div>
                </div>
            </div>
        @endif
        <div class="mt-5">
            <a href="{{ route('maquinas.show', $maquina) }}"><i class="fas fa-chevron-left"></i>&nbsp; Regresar</a>
        </div>
    </div>
@endsection
