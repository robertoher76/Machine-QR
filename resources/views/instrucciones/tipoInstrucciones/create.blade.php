@extends('..layouts.plantilla')

@section('cabecera')
<div class="container mt-5">
  <h2>Agregar Tipo de Instrucción</h2>
  <p class="lead">Ingrese los siguientes datos para registrar un nuevo tipo de instrucción a la aplicación.</p>
</div>
@endsection

@section('contenido')
    <div class="container mt-3">    
        <form autocomplete="off" id="form-general" method="POST" action="{{url('/instrucciones/tipo')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nombre" class="ml-1 {{ ($errors->has('nombre')) ? 'text-danger' : '' }}">Nombre de Instrucción</label>
                <input type="text" autocomplete="off" class="form-control {{ ($errors->has('nombre')) ? 'border border-danger' : '' }}" id="nombre" name="nombre" value="{{ old('nombre') }}">
                @if($errors->has('nombre'))
                    <small class="text-danger ml-2" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('nombre') }}</small>
                @endif    
            </div>
            <div class="form-group">
                <label for="descripcion" class="ml-1 {{ ($errors->has('descripcion_tipo')) ? 'text-danger' : '' }}">Descripción de la instrucción</label>
                <textarea class="form-control {{ ($errors->has('descripcion_tipo')) ? 'border border-danger' : '' }}" id="descripcion" name="descripcion_tipo" rows="3">{{ old('descripcion_tipo') }}</textarea>
                @if($errors->has('descripcion_tipo'))
                    <small class="text-danger ml-2" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('descripcion_tipo') }}</small>
                @else
                    <small for="descripcion" class="form-text text-muted">Descripción completa del tipo de instrucción. Límite de caracteres: 600.</small>
                @endif          
            </div>
            <br/>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
        </form>
    </div>
@endsection