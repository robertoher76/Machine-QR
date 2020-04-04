@extends('..layouts.plantilla')

@section('cabecera')
<div class="container mt-5">
  <h2 style="color: black;">Agregar Instrucción</h2>
  <p class="lead">Ingrese los siguientes datos para registrar una nueva instrucción.</p>
</div>
@endsection

@section('contenido')
<div class="container mt-4">
    <form autocomplete="off" id="form-general" method="POST" action="{{url('/maquinas/'.$maquina->id.'/instrucciones')}}">
        @csrf
        <input type="hidden" name="maquina_id" value="{{ $maquina->id }}">
        <div class="form-group">
          <label for="titulo" class="ml-1 {{ ($errors->has('titulo')) ? 'text-danger' : '' }}">Título de la Instrucción</label>
          <input type="text" autocomplete="off" class="form-control {{ ($errors->has('titulo')) ? 'border border-danger' : '' }}" id="titulo" name="titulo" value="{{ old('titulo') }}">
          @if($errors->has('titulo'))
            <small class="text-danger ml-2" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('titulo') }}</small>
          @endif
        </div>
        <div class="form-group">
            <label for="instrucciones_tipo_id " class="ml-1 {{ ($errors->has('instrucciones_tipo_id')) ? 'text-danger' : '' }}">Tipo de Instrucción</label>
            <select class="form-control {{ ($errors->has('instrucciones_tipo_id')) ? 'border border-danger' : '' }}" id="instrucciones_tipo_id" name="instrucciones_tipo_id">
                @foreach ($instrucciones_tipo as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                @endforeach
            </select>
            @if($errors->has('instrucciones_tipo_id '))
              <small class="text-danger ml-2" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('instrucciones_tipo_id') }}</small>
            @endif
          </div>
        <div class="form-group">
            <label for="descripcion" class="ml-1 {{ ($errors->has('descripcion')) ? 'text-danger' : '' }}">Descripción de la Instrucción</label>
            <textarea class="form-control {{ ($errors->has('descripcion')) ? 'border border-danger' : '' }}" id="descripcion" name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
            @if($errors->has('descripcion'))
                <small class="text-danger ml-2" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('descripcion') }}</small>
            @else
                <small for="descripcion" class="form-text text-muted">Descripción completa de la Instrucción. Límite de caracteres: 1500.</small>
            @endif
        </div>
        @if(count($lists) > 0)
            <div class="form-group">
                <label for="orden" class="ml-1 {{ ($errors->has('numero_orden')) ? 'text-danger' : '' }}">Posición de la Introducción</label>
                <select class="form-control {{ ($errors->has('numero_orden')) ? 'border border-danger' : '' }}" id="orden" name="numero_orden">
                    @foreach($lists as $list)
                        @if($loop->first)
                            <option value="{{ $list->numero_orden }}" selected>La primera Instrucción</option>
                        @endif
                        <option value="{{ $list->numero_orden + 1 }}">Después de {{ $list->titulo }}</option>
                    @endforeach
                </select>
                @if($errors->has('numero_orden'))
                    <small class="text-danger ml-2" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('numero_orden') }}</small>
                @endif
            </div>
        @else
            <input type="hidden" name="numero_orden" value="1"/>
        @endif
        <br/>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
    </form>
</div>

@endsection

