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

@if(count($errors)>0)
  <div class="alert alert-warning" role="alert">
      @foreach ($errors->all() as $error)
        {{ $error }} <br/>
      @endforeach
  </div>  
@endif

<form autocomplete="off" id="form-general" method="POST" action="{{url('/maquinas/'.$maquina->id.'/componente')}}" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="maquina_id" value="{{ $maquina->id }}">
  <div class="form-group">
    <label for="nombre">Nombre del Componente</label>
    <input type="text" autocomplete="off" class="form-control" id="nombre" name="nombre">    
  </div>
  <div class="form-group">
    <label for="descripcion">Descripción del Componente</label>
    <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
    <small for="descripcion" class="form-text text-muted">Descripción completa del funcionamiento del componente. Límite de caracteres: 1500.</small>
  </div> 
  <div class="form-group">
    <label for="foto">Imagen del Componente</label>          
    <input id="foto" name="foto_up" type="file">
    <small for="foto" class="form-text text-muted">Ingrese un archivo con formato: jpg, jpeg o png y que no sobrepase los 2500 kilobytes.</small>        
  </div>
  <br/>
  <div class="text-center">
  <button type="submit" class="btn btn-primary">Agregar</button>
  </div>
</form>
</div>

@endsection