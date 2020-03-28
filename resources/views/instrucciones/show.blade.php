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
        <div class="row">
            @foreach($instruccion as $ins)
            <div class="col-12">
                <h1>{{ $ins->titulo }} <button type="button" class="btn btn-outline-success btn-sm"><i class="far fa-edit"></i> Modificar</button></h1>
                <small class="form-text text-muted">Tipo de Instrucción: {{ $ins->nombre }}  |  Modificado {{ $ins->updated_at->format('d-m-Y') }}</small>
                <br/>
                <p class="lead">{{ $ins->descripcion}}</p>
                <br/>
            </div>
              @php($nombre = $ins->nombre_maquina)
              @php($ID = $ins->maquina_id)    
            @endforeach     
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
                  <div>
                      <a href="{{ Request::url() }}/edit" class="btn btn-outline-success btn-sm"><i class="far fa-edit"></i> Modificar</a>
                      <a href="{{ Request::url() }}/edit" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Eliminar</a>   
                  </div> 
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
            <a href="{{ Request::root() }}/maquinas/{{ $ID ?? '' }}">Ir a {{ $nombre ?? '' }}</a>
        </p>
    </div>

</div>
@endsection
