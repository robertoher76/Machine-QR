@extends('..layouts.plantilla')

@push('css')
    <link rel="stylesheet" href = "{{ asset('css/show.css') }}" />
@endpush

@section('cabecera')
    <div class="container mt-sm-3 mt-md-3 mt-lg-5 mt-xl-5">
        @if($errors->has('error'))
            @include('..layouts.toastDanger', ['title' => 'Advertencia', 'error' => $errors->first('error')])
        @elseif($errors->has('success'))
            @include('..layouts.toastSuccess', ['title' => 'Exitosamente', 'success' => $errors->first('success')])
        @endif
        <h2 class="d-flex flex-wrap">{{ $tutoriale->titulo }} &nbsp;
            @auth
                <td>
                    <form method="POST" action="{{ route('tutoriales.destroy', $tutoriale) }}">
                        <a href="{{ route('tutoriales.edit', $tutoriale) }}" class="btn btn-outline-success btn-sm"><i class="far fa-edit"></i> Modificar</a>
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-outline-danger btn-sm" type="submit"><i class="far fa-trash-alt"></i> Eliminar</button>
                    </form>
                </td>
            @endauth
        </h2>
        <small class="form-text text-muted">Tutorial de <a href="{{ route('maquinas.show', $maquina) }}">{{ $maquina->nombre_maquina }}</a> @auth| Última Modificación {{ $tutoriale->updated_at->format('d-m-Y') }} @endauth</small>
        <p style="font-size: 19px;" class="lead mt-1">{{ $tutoriale->descripcion}}</p>
        <br/>
    </div>
@endsection

@section('contenido')
    <div class="container ">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mx-auto">
            <video  src="{{ asset('storage/tutoriales/' . $tutoriale->video) }}" controls>
                Tu navegador no implementa el elemento <code>video</code>.
            </video>
        </div>
        <div class="mt-5">
            <a href="{{ route('maquinas.tutoriales.index', $maquina) }}"><i class="fas fa-chevron-left"></i>&nbsp; Regresar</a>
        </div>
    </div>    
@endsection
