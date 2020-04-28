@extends('..layouts.plantilla')

@section('cabecera')
<div class="container mt-sm-3 mt-md-3 mt-lg-5 mt-xl-5">
  <h2>Agregar Tipo de Instrucción</h2>
  <p class="lead">Ingrese los siguientes datos para registrar un nuevo tipo de instrucción a la aplicación.</p>
</div>
@endsection

@section('contenido')
    <div class="container mt-3">    
        <form autocomplete="off" id="form-general" method="POST" action="{{ route('tipo.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nombre" class="ml-1 @error('nombre') text-danger @enderror">Nombre del Tipo de Instrucción</label>
                <input type="text" autocomplete="off" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}">
                @error('nombre')
                    <small class="text-danger ml-1" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('nombre') }}</small>
                @enderror  
            </div>
            <div class="form-group">
                <label for="descripcion" class="ml-1 @error('descripcion_tipo') @enderror">Descripción</label>
                <textarea class="form-control @error('descripcion_tipo') is-invalid @enderror" id="descripcion" name="descripcion_tipo" rows="3">{{ old('descripcion_tipo') }}</textarea>
                @if($errors->has('descripcion_tipo'))
                    <small class="text-danger ml-1" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('descripcion_tipo') }}</small>
                @else
                    <small for="descripcion" class="form-text text-muted ml-1">Descripción completa del tipo de instrucción. Límite de caracteres: 600.</small>
                @endif          
            </div>
            <br/>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
            <div class="mt-3">
                <a href="{{ route('tipo.index') }}"><i class="fas fa-chevron-left"></i>&nbsp; Regresar</a>
            </div>
        </form>
    </div>
@endsection