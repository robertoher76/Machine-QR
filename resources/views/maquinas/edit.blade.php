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
    @if((old('cambiarImagen') != null))
        <script src="{{ asset('js/checked.js') }}"></script>
    @endif
@endpush

@section('cabecera')
    <div class="container mt-sm-3 mt-md-3 mt-lg-5 mt-xl-5">
        <h2 style="color: black;" class="text-justify">Modificar {{ $maquina->nombre_maquina }} <small style="font-size:18px;" class="text-muted">&nbsp; Última modificación {{ $maquina->updated_at->format('d-m-Y') }}.</small></h2>
        <p class="lead">Modifique los siguientes campos para realizar cambios en la máquina.</p>
    </div>
@endsection

@section('contenido')
    <div class="container mt-4">
        @if($errors->has('error'))
            @include('..layouts.toastDanger', ['title' => 'Advertencia', 'error' => $errors->first('error')])
        @elseif($errors->has('success'))
            @include('..layouts.toastSuccess', ['title' => 'Exitosamente', 'success' => $errors->first('success')])
        @endif
        <form autocomplete="off" id="form-general" method="POST" action="{{url('/maquinas/'.$maquina->id)}}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="nombre" class="ml-1 {{ ($errors->has('nombre_maquina')) ? 'text-danger' : '' }}">Nombre de la Máquina:</label>
                <input type="text" autocomplete="off" class="form-control {{ ($errors->has('nombre_maquina')) ? 'border border-danger' : '' }}" id="nombre" name="nombre_maquina" value="{{ (old('nombre_maquina') != null) ? old('nombre_maquina') : $maquina->nombre_maquina }}">
                @if($errors->has('nombre_maquina'))
                    <small class="text-danger ml-2" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('nombre_maquina') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="descripcion" class="ml-1 {{ ($errors->has('descripcion')) ? 'text-danger' : '' }}">Descripción del funcionamiento de la máquina:</label>
                <textarea class="form-control {{ ($errors->has('descripcion')) ? 'border border-danger' : '' }}" id="descripcion" name="descripcion" rows="3">{{ (old('descripcion') != null) ? old('descripcion') : $maquina->descripcion }}</textarea>
                @if($errors->has('descripcion'))
                    <small class="text-danger ml-2" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('descripcion') }}</small>
                @else
                    <small for="descripcion" class="form-text text-muted">Descripción completa del funcionamiento de la máquina. Límite de caracteres: 1500.</small>
                @endif
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="modificarIMG" name="cambiarImagen" value="falso">
                <label class="form-check-label" for="modificarIMG">Cambiar imagen de {{$maquina->nombre_maquina}}</label>
            </div>
            <div class="form-group text-center" id="imagenActual">
                <a class="example-image-link" href="{{ asset('storage/imagenes/maquinas/' . $maquina->imagen) }}" data-lightbox="example-set" data-title="Imagen actual para {{ $maquina->nombre_maquina }}"><img class="example-image mt-3 ml-1 mr-1" style="border-radius: 2%;" widht="100%;" height="250px;" src="{{ asset('storage/imagenes/maquinas/' . $maquina->imagen) }}"/></a>
                <br/>
                <p class="form-text text-muted">Imagen Actual Para {{ $maquina->nombre_maquina }}</p>
            </div>
            <div class="form-group" id="div_foto">
                <label for="foto" class="ml-1 {{ ($errors->has('foto_up')) ? 'text-danger' : '' }}">Imagen de la máquina</label>
                <input id="foto" name="foto_up" type="file">
                @if($errors->has('foto_up'))
                    <small class="text-danger ml-2" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('foto_up') }}</small>
                @else
                    <small for="foto" class="form-text text-muted">Ingrese un archivo con formato: jpg, jpeg o png y que no sobrepase los 2500 kilobytes.</small>
                @endif
            </div>
            <br/>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Modificar</button>
            </div>
        </form>
        <div class="mt-4">
            <a href="{{ Request::root() }}/maquinas/{{$maquina->id}}"><i class="fas fa-chevron-left"></i>&nbsp; Regresar</a>
        </div>
    </div>
@endsection
