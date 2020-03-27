@extends('..layouts.plantilla')

@push('css')
<link href="{{ asset('js/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/style-file-input.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('js')
<script src="{{ asset('js/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <!-- following theme script is needed to use the Font Awesome 5.x theme (`fas`) -->
    <script src="{{ asset('js/bootstrap-fileinput/themes/fas/theme.min.js') }}"></script>
    <!-- optionally if you need translation for your language then include the locale file as mentioned below (replace LANG.js with your language locale) -->
    <script src="{{ asset('js/bootstrap-fileinput/js/locales/es.js') }}"></script>
    
    <script src="{{ asset('js/crear.js') }}"></script>
@endpush

@section('cabecera')
<div class="container mt-5">
  <h2 style="color: black;">Agregar Componente</h2>
  <p class="lead">Ingrese los siguientes datos para registrar un nuevo componente a la máquina {{ $maquina->nombre_maquina }}.</p>
</div>
@endsection

@section('contenido')
    
<div class="container mt-3">    

  <form autocomplete="off" id="form-general" method="POST" action="{{url('/maquinas/'.$maquina->id.'/componente')}}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="maquina_id" value="{{ $maquina->id }}">
    <div class="form-group">
      <label for="nombre" class="{{ ($errors->has('nombre')) ? 'text-danger' : '' }}">Nombre del Componente</label>
      <input type="text" autocomplete="off" class="form-control {{ ($errors->has('nombre')) ? 'border border-danger' : '' }}" id="nombre" name="nombre" value="{{ old('nombre') }}">    
      @if($errors->has('nombre'))
        <small class="text-danger ml-2" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('nombre') }}</small>
      @endif
    </div>
    <div class="form-group">
      <label for="descripcion" class="ml-1 {{ ($errors->has('descripcion')) ? 'text-danger' : '' }}">Descripción del Componente</label>
      <textarea class="form-control {{ ($errors->has('descripcion')) ? 'border border-danger' : '' }}" id="descripcion" name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
      @if($errors->has('descripcion'))
        <small class="text-danger ml-2" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('descripcion') }}</small>
      @else
        <small for="descripcion" class="form-text text-muted">Descripción completa del funcionamiento del componente. Límite de caracteres: 1500.</small>
      @endif      
    </div> 
    <div class="form-group">
      <label for="foto" class="ml-1 {{ ($errors->has('foto_up')) ? 'text-danger' : '' }}">Imagen del Componente</label>          
      <input id="foto" name="foto_up" type="file" class="{{ ($errors->has('foto_up')) ? 'border border-danger' : '' }}">
      @if($errors->has('foto_up'))
        <small class="text-danger ml-2" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('foto_up') }}</small>
      @else
        <small for="foto" class="form-text text-muted">Ingrese un archivo con formato: jpg, jpeg o png y que no sobrepase los 2500 kilobytes.</small>        
      @endif
    </div>
    <br/>
    <div class="text-center">
      <button type="submit" class="btn btn-primary">Agregar</button>
    </div>
  </form>
</div>

@endsection