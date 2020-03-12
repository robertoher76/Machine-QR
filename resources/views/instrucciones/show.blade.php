@extends('..layouts.plantilla')

@section('cabecera')
    <div class="container mt-5">
        <div class="row">
            @foreach($instruccion as $ins)
            <div class="col-12">
                <h1>{{ $ins->titulo }} <button type="button" class="btn btn-success btn-sm">Editar</button></h1>
                
                <small class="form-text text-muted">Tipo de Instrucción: {{ $ins->nombre }}  |  Modificado {{ $ins->updated_at->format('d-m-Y') }}</small>
                <br/>
                <p class="lead">{{ $ins->descripcion}}</p>
                <br/>
                
            </div>
            @endforeach            
        </div>
    </div>
@endsection

@section('contenido')
<div class="container mt-2">
    
  <div class="accordion" id="accordionExample">  

    @foreach($procedimientos as $procedimiento)
    <div class="card">
      <div class="card-header" id="heading{{ $procedimiento->numero_orden }}">
        <h2 class="mb-0">
          <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapse{{ $procedimiento->numero_orden }}" aria-expanded="true" aria-controls="collapse{{ $procedimiento->numero_orden }}">
            PROCEDIMIENTO #{{ $procedimiento->numero_orden }}
          </button>
        </h2>
      </div>

      <div id="collapse{{ $procedimiento->numero_orden }}"  aria-labelledby="heading{{ $procedimiento->numero_orden }}" data-parent="#accordionExample">
        
        <div class="card-body row">
          
          <div class="col-8">
            <h4>{{ $procedimiento->descripcion }}</h4>
            <p>Modificado {{ $procedimiento->updated_at->format('d-m-Y') }}</p>
          </div>
          <div class="col-4">
            <div class="text-center">
              <img src="{{ asset('imagenes/maquinas/' . $procedimiento->imagen) }}" width="100%" height="auto;"  alt="Responsive image">
            </div>
          </div>
        
        </div>

        <div class="card-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-success">Modificar</button>
          </div>
        </div>
      
      </div>

    </div>
    @endforeach

  </div>

  <div class="mt-5 text-center">
    @foreach($instruccion as $ins)
      <p class=" mt-10">
        <a href="{{ Request::root() }}/maquinas/{{ $ins->maquina_id }}">Regresar a {{ $ins->nombre_maquina}}</a>
      </p>
      @endforeach
  </div>

</div>
@endsection
