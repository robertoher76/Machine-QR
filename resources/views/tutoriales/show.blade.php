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
        <h1 style="display:flex;flex-wrap: wrap;">{{ $tutoriale->titulo }} &nbsp;
            <td>
                <form method="POST" action="{{url('/maquinas/'.$maquina->id.'/tutoriales/'.$tutoriale->id)}}">
                    <a href="{{ Request::url() }}/edit" class="btn btn-outline-success btn-sm"><i class="far fa-edit"></i> Modificar</a>
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-outline-danger btn-sm" type="submit"><i class="far fa-trash-alt"></i> Eliminar</button>
                </form>
            </td>
        </h1>
        <small class="form-text text-muted">Tutorial de <a href="/maquinas/{{ $maquina->id }}">{{ $maquina->nombre_maquina }}</a> | Última Modificación {{ $tutoriale->updated_at->format('d-m-Y') }}</small>
        <p style="font-size: 19px;" class="lead mt-2">{{ $tutoriale->descripcion}}</p>
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
    </div>
    <div class="container mt-2">
        <div class="mt-5">
            <a href="{{ Request::root() }}/maquinas/{{$maquina->id}}/tutoriales"><i class="fas fa-chevron-left"></i>&nbsp; Regresar</a>
        </div>
    </div>
@endsection
