@extends('..layouts.plantilla')

@section('cabecera')
    <div class="container mt-sm-3 mt-md-3 mt-lg-5 mt-xl-5">
        <h1 class="text-body d-flex flex-wrap">{{ $tipo->nombre }} &nbsp;            
            <td>
                <form method="POST" action="{{ route('tipo.destroy', $tipo) }}">
                    <a href="{{ route('tipo.edit', $tipo) }}" class="btn btn-outline-success btn-sm"><i class="far fa-edit"></i> Modificar</a>
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-outline-danger btn-sm" type="submit"><i class="far fa-trash-alt"></i> Eliminar</button>
                </form>
            </td>
        </h1>
        <small class="form-text text-muted mb-1">Última Modificación {{ $tipo->updated_at->format('d-m-Y') }}</small>
        <p style="font-size: 19px;" class="lead">{{ $tipo->descripcion_tipo }}</p>
        <div class="mt-5">
            <a href="{{ route('tipo.index') }}"><i class="fas fa-chevron-left"></i>&nbsp; Regresar</a>
        </div>
    </div>
@endsection