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
        <div class="row">
            <div class="col-12">
                <h1>{{ $instruccion->titulo }}
                    <td>
                        <form method="POST" action="{{url('/maquinas/'.$maquina->id.'/instrucciones/'. $instruccion->id)}}">
                            <a href="{{ Request::url() }}/edit" class="btn btn-outline-success btn-sm"><i class="far fa-edit"></i> Modificar</a>
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-outline-danger btn-sm" type="submit"><i class="far fa-trash-alt"></i> Eliminar</button>
                        </form>
                    </td>
                </h1>
                <small class="form-text text-muted">Tipo de Instrucción: {{ $tipo->nombre }}  |  Modificado {{ $instruccion->updated_at->format('d-m-Y') }}</small>
                <br/>
                <p class="lead">{{ $instruccion->descripcion}}</p>
                <br/>
            </div>
        </div>
    </div>
@endsection

@section('contenido')
<div class="container mt-2">
    <div class="row">
      <div class="col-4">
        <div class="list-group" id="list-tab" role="tablist">
          @foreach($procedimientos as $procedimiento)
            <a class="list-group-item list-group-item-action {{ ($procedimiento->numero_orden == 1) ? 'active' : '' }}" id="list-{{ $procedimiento->numero_orden }}-list" data-toggle="list" href="#list-{{ $procedimiento->numero_orden }}" role="tab" aria-controls="{{ $procedimiento->numero_orden }}">Procedimiento #{{ $procedimiento->numero_orden }}</a>
          @endforeach
        <a class="list-group-item list-group-item-action " href="{{ Request::root() }}/maquinas/instrucciones/{{ $instruccion->id }}/procedimientos/create"><i class="fas fa-plus text-success"></i> Agregar Procedimiento</a>
        </div>
      </div>
      <div class="col-8">
        <div class="tab-content" id="nav-tabContent">
          @foreach($procedimientos as $procedimiento)
            <div class="tab-pane fade {{ ($procedimiento->numero_orden == 1) ? 'show active' : '' }}" id="list-{{ $procedimiento->numero_orden }}" role="tabpanel" aria-labelledby="list-{{ $procedimiento->numero_orden }}-list">
              <div class="row">
                <div class="col-12">
                  <h4>{{ $procedimiento->descripcion }}</h4>
                  <p>Modificado {{ $procedimiento->updated_at->format('d-m-Y') }}</p>
                  <td>
                      <form method="POST" action="{{url('/maquinas/instrucciones/'. $instruccion->id .'/procedimientos/'.$procedimiento->id )}}">
                        <a href="{{ Request::root() }}/maquinas/instrucciones/{{ $instruccion->id }}/procedimientos/{{ $procedimiento->id }}/edit" class="btn btn-outline-success btn-sm"><i class="far fa-edit"></i> Modificar</a>
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-outline-danger btn-sm" type="submit"><i class="far fa-trash-alt"></i> Eliminar</button>
                      </form>
                  </td>
                </div>
                <div class="col-12 mt-4">
                  <div class="text-center">
                    <a class="example-image-link" data-title="Procedimiento #{{ $procedimiento->numero_orden }}" href="{{ asset('storage/imagenes/procedimientos/' . $procedimiento->imagen) }}" data-lightbox="example-1"><img class="example-image ml-1 mr-1" style="border-radius: 2%;widht 100% !important;" widht="100%;" height="200px;" src="{{ asset('storage/imagenes/procedimientos/' . $procedimiento->imagen) }}"/></a>
                    <small class="form-text text-muted">Click sobre la imagen para ampliarla.</small>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
</div>
<div class="container mt-5">
    <div class="container mt-10 text-center">
        <p>
            <a href="{{ Request::root() }}/maquinas/{{ $maquina->id }}/instrucciones">Regresar listado de Instrucciones</a>
        </p>
    </div>

</div>
@endsection
