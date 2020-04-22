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
<div class="container mt-sm-3 mt-md-3 mt-lg-5 mt-xl-5">
    <h2>Agregar Máquina</h2>
    <p class="lead">Ingrese los siguientes datos para registrar una nueva máquina a la aplicación.</p>
</div>
@endsection

@section('contenido')
    <div class="container mt-4">
        @if($errors->has('error'))
            @include('..layouts.toastDanger', ['title' => 'Advertencia', 'error' => $errors->first('error')])
        @elseif($errors->has('success'))
            @include('..layouts.toastSuccess', ['title' => 'Exitosamente', 'success' => $errors->first('success')])
        @endif
        <form autocomplete="off" id="form-general" method="POST" action="{{url('/maquinas')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nombre" class="ml-1 {{ ($errors->has('nombre_maquina')) ? 'text-danger' : '' }}">Nombre de la Máquina</label>
                <input type="text" autocomplete="off" class="form-control {{ ($errors->has('nombre_maquina')) ? 'is-invalid' : '' }}" id="nombre" name="nombre_maquina" value="{{ old('nombre_maquina') }}">
                @if($errors->has('nombre_maquina'))
                    <small class="text-danger ml-2" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('nombre_maquina') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="descripcion" class="ml-1 {{ ($errors->has('descripcion')) ? 'text-danger' : '' }}">Funcionamiento de la Máquina</label>
                <textarea class="form-control {{ ($errors->has('descripcion')) ? 'is-invalid' : '' }}" id="descripcion" name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
                @if($errors->has('descripcion'))
                    <small class="text-danger ml-2" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('descripcion') }}</small>
                @else
                    <small for="descripcion" class="form-text text-muted">Descripción completa del funcionamiento de la máquina. Límite de caracteres: 1500.</small>
                @endif
            </div>
            <div class="form-group">
                <label for="foto" class="ml-1 {{ ($errors->has('foto_up')) ? 'text-danger' : '' }}">Imagen de la máquina</label>
                <input id="foto" name="foto_up" type="file" class="{{ ($errors->has('foto_up')) ? 'is-invalid' : '' }}">
                @if($errors->has('foto_up'))
                    <small class="text-danger ml-2" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('foto_up') }}</small>
                @else
                    <small for="foto" class="form-text text-muted">Ingrese un archivo con formato: jpg, jpeg o png y que no sobrepase los 4000 kilobytes.</small>
                @endif
            </div>
            <br/><br/>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
        </form>
        <div class="mt-4">
            <a href="{{ Request::root() }}/maquinas"><i class="fas fa-chevron-left"></i>&nbsp; Regresar</a>
        </div>
    </div>
@endsection
