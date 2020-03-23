@extends('..layouts.plantilla')

@push('css')
<link href="{{ asset('js/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('css/style-file-input.css') }}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href = "{{ asset('css/lightbox.min.css') }}" />
@endpush

@push('js')
<script src="{{ asset('js/lightbox-plus-jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <!-- following theme script is needed to use the Font Awesome 5.x theme (`fas`) -->
    <script src="{{ asset('js/bootstrap-fileinput/themes/fas/theme.min.js') }}"></script>
    <!-- optionally if you need translation for your language then include the locale file as mentioned below (replace LANG.js with your language locale) -->
    <script src="{{ asset('js/bootstrap-fileinput/js/locales/es.js') }}"></script>        
    <script src="{{ asset('js/crear.js') }}"></script>
    <script src="{{ asset('js/editar.js') }}"></script>
    
@endpush

@section('cabecera')
<div class="container mt-5">
  <h1 style="color: black;" class="text-justify">Modificar {{ $maquina->nombre_maquina }} <small style="font-size:18px;" class="text-muted">&nbsp; Última modificación {{ $maquina->updated_at->format('d-m-Y') }}.</small></h1>
  <p class="lead">Ingrese los siguientes datos para modificar la máquina.</p>
</div>
@endsection

@section('contenido')

    <div class="container mt-4">    

      @if(count($errors)>0)
        <div class="alert alert-warning" role="alert">
            @foreach ($errors->all() as $error)
              {{ $error }} <br/>
            @endforeach
        </div>
      @endif
      
      <form autocomplete="off" id="form-general" method="POST" action="{{url('/maquinas/'.$maquina->id)}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group">
          <label for="nombre">Nombre de la Máquina:</label>
          <input type="text" autocomplete="off" class="form-control" id="nombre" name="nombre_maquina" value="{{ $maquina->nombre_maquina }}">    
        </div>
        <div class="form-group">
          <label for="descripcion">Descripción del funcionamiento de la máquina:</label>
          <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ $maquina->descripcion }}</textarea>
          <small for="descripcion" class="form-text text-muted">Descripción completa del funcionamiento de la máquina. Límite de caracteres: 600.</small>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="modificarIMG" name="cambiarImagen" value="falso">
            <label class="form-check-label" for="modificarIMG">Cambiar imagen de la máquina</label>
        </div>
        <div class="form-group text-center" id="imagenActual">
          <a class="example-image-link" href="{{ asset('storage/imagenes/maquinas/' . $maquina->imagen) }}" data-lightbox="example-set" data-title="Imagen actual para {{ $maquina->nombre_maquina }}"><img class="example-image mt-3 ml-1 mr-1" style="border-radius: 2%;" widht="100%;" height="300px;" src="{{ asset('storage/imagenes/maquinas/' . $maquina->imagen) }}"/></a>
          <br/>
          <p class="form-text text-muted">Imagen Actual Para {{ $maquina->nombre_maquina }}</p>
        </div> 
        <div class="form-group" id="div_foto">
          <label for="foto">Imagen de la máquina</label>          
          <input id="foto" name="foto_up" type="file">
          <small class="form-text text-muted">Ingrese un archivo con formato: jpg, jpeg o png y que no sobrepase los 2500 kilobytes.</small>        
        </div>
        <br/><br/>
        <div class="text-center">
        <button type="submit" class="btn btn-primary">Modificar</button>
        </div>
      </form>
    </div>
    
@endsection
