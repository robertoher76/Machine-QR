@extends('..layouts.plantilla')

@push('css')
<link href="{{ asset('js/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/style-file-input.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('js')
<script src="{{ asset('js/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-fileinput/themes/fas/theme.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-fileinput/js/locales/es.js') }}"></script>
    <script src="{{ asset('js/crear.js') }}"></script>
@endpush

@section('cabecera')
    <div class="container mt-sm-3 mt-md-3 mt-lg-5 mt-xl-5">
        <h2 class="text-body">Agregar Imagen</h2>
        <p class="lead">Ingrese los siguientes datos para registrar una nueva imagen a la galería de {{ $maquina->nombre_maquina }}.</p>
    </div>
@endsection

@section('contenido')
    <div class="container mt-2">
        @if($errors->has('error'))
            @include('..layouts.toastDanger', ['title' => 'Advertencia', 'error' => $errors->first('error')])
        @elseif($errors->has('success'))
            @include('..layouts.toastSuccess', ['title' => 'Exitosamente', 'success' => $errors->first('success')])
        @endif
        <form autocomplete="off" id="form-general" method="POST" action="{{ route('maquinas.galeria.store', $maquina) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="foto" class="ml-1 @error('foto_up') text-danger @enderror">Imagen</label>
                <input id="foto" name="foto_up" type="file">
                @if($errors->has('foto_up'))
                    <small class="text-danger ml-1" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('foto_up') }}</small>
                @else
                    <small for="foto" class="form-text text-muted ml-1">Ingrese un archivo con formato: jpg, jpeg o png y que no sobrepase los 4000 kilobytes.</small>
                @endif
            </div>
            <div class="form-group">
                <label for="descripcion" class="ml-1 @error('descripcion') text-danger @enderror">Descripción de la Imagen</label>
                <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
                @if($errors->has('descripcion'))
                    <small class="text-danger ml-1" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('descripcion') }}</small>
                @else
                    <small for="descripcion" class="form-text text-muted ml-1">Descripción de la imagen. Límite de caracteres: 1500.</small>
                @endif
            </div>
            <br/>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
        </form>
        <div class="mt-3">
            <a href="{{ route('maquinas.galeria.index', $maquina) }}"><i class="fas fa-chevron-left"></i>&nbsp; Regresar</a>
        </div>
    </div>
    @error('foto_up')
        <style>
            .file-caption{
                border-color: #dc3545;                
            }
        </style>
    @enderror
@endsection