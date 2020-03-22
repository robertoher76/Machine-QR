@extends('..layouts.plantilla')

@push('scripts')
  <link href="{{ asset('js/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet" type="text/css" />
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
  <h1 style="color: black;">Agregar Máquina</h1>
  <p class="lead">Ingrese los siguientes datos para registrar una nueva máquina a la aplicación.</p>
</div>
@endsection

@section('contenido')
<style>
.kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
    margin: 0;
    padding: 0;
    border: none;
    box-shadow: none;
    text-align: center;
}
.kv-avatar {
    display: inline-block;
}
.kv-avatar .file-input {
    display: table-cell;
    width: 213px;
}
.kv-reqd {
    color: red;
    font-family: monospace;
    font-weight: normal;
}
</style>

    <div class="container mt-3">    

      @if(count($errors)>0)
        <div class="alert alert-warning" role="alert">
            @foreach ($errors->all() as $error)
              {{ $error }} <br/>
            @endforeach
        </div>
      @endif
      
      <form autocomplete="off" id="form-general" method="POST" action="{{url('/maquinas')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="nombre">Nombre de la Máquina</label>
          <input type="text" autocomplete="off" class="form-control" id="nombre" name="nombre_maquina">    
        </div>
        <div class="form-group">
          <label for="descripcion">Funcionamiento de la Máquina</label>
          <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
          <small id="descripcion" class="form-text text-muted">Descripción completa del funcionamiento de la máquina. Límite de caracteres: 600.</small>
        </div> 
        <div class="form-group">
          <label for="foto">Imagen de la máquina</label>          
          <input id="foto" name="foto_up" type="file">
          <small id="foto" class="form-text text-muted">Ingrese un archivo con formato: jpg, jpeg o png y que no sobrepase los 2500 kilobytes.</small>        
        </div>
        <br/><br/>
        <div class="text-center">
        <button type="submit" class="btn btn-primary btn-lg">Ingresar</button>
        </div>
      </form>
    </div>
    
@endsection