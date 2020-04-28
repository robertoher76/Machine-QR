@extends('..layouts.plantilla')

@push('css')
<link href="{{ asset('js/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/style-file-input.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/show.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('js')
<script src="{{ asset('js/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-fileinput/themes/fas/theme.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-fileinput/js/locales/es.js') }}"></script>
    <script src="{{ asset('js/crear-video.js') }}"></script>
    <script src="{{ asset('js/editar.js') }}"></script>
    @if((old('cambiarImagen') != null))
        <script src="{{ asset('js/checked.js') }}"></script>
    @endif
@endpush

@section('cabecera')
<div class="container mt-sm-3 mt-md-3 mt-lg-5 mt-xl-5">
  <h2>Modificar {{ $tutoriale->titulo }}</h2>
  <p class="lead">Ingrese los siguientes datos para modificar el tutorial que pertenece {{ $maquina->nombre_maquina }}.</p>
</div>
@endsection

@section('contenido')
    <div class="container mt-3">
        <form autocomplete="off" id="form-general" method="POST" action="{{ route('tutoriales.update', $tutoriale) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="nombre" class="ml-1 @error('titulo') text-danger @enderror">Título del tutorial</label>
                <input type="text" autocomplete="off" class="form-control @error('titulo') is-invalid @enderror" id="nombre" name="titulo" value="{{ (old('titulo') != null) ? old('titulo') : $tutoriale->titulo }}">
                @error('titulo')
                    <small class="text-danger ml-1" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="descripcion" class="ml-1 @error('descripcion') text-danger @enderror">Descripción del video</label>
                <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3">{{ (old('descripcion') != null) ? old('descripcion') : $tutoriale->descripcion }}</textarea>
                @if($errors->has('descripcion'))
                    <small class="text-danger ml-1" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('descripcion') }}</small>
                @else
                    <small for="descripcion" class="form-text text-muted ml-1">Descripción completa del tutorial. Límite de caracteres: 1500.</small>
                @endif
            </div>
            @if(count($lists) > 0)
                <div class="form-group">
                    <label for="orden" class="ml-1 @error('numero_orden') text-danger @enderror">Posición del Tutorial</label>
                    <select class="form-control @error('numero_orden') is-invalid @enderror" id="orden" name="numero_orden">
                        @foreach($lists as $list)
                            @if($loop->iteration >= $tutoriale->numero_orden)
                                @if($tutoriale->numero_orden != 1 && $loop->first)
                                    <option value="{{ $list->numero_orden }}">El Primer Tutorial</option>
                                @endif
                                @if($tutoriale->numero_orden == $list->numero_orden)
                                    <option value="{{ $list->numero_orden }}" selected>Mantener Posición</option>
                                @elseif($tutoriale->numero_orden-1 != $list->numero_orden)
                                    <option value="{{ $list->numero_orden }}">Después de {{ $list->titulo }}</option>
                                @endif
                            @else
                                @if($tutoriale->numero_orden != 1 && $loop->first)
                                    <option value="{{ $list->numero_orden }}">La primera Instrucción</option>
                                @endif
                                @if($tutoriale->numero_orden-1 != $list->numero_orden)
                                    <option value="{{ $list->numero_orden + 1 }}">Después de {{ $list->titulo }}</option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                    @error('numero_orden')
                        <small class="text-danger ml-1" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $message }}</small>
                    @endif
                </div>
            @else
                <input type="hidden" name="numero_orden" value="1"/>
            @endif
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="modificarIMG" name="cambiarImagen" value="falso">
                <label class="form-check-label" for="modificarIMG">Cambiar Tutorial</label>
            </div>

            <div class="form-group text-center" id="imagenActual">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mx-auto">
                        <video src="{{ asset('storage/tutoriales/' . $tutoriale->video) }}" controls>
                            Tu navegador no implementa el elemento <code>video</code>.
                        </video>
                        <br/>
                        <p class="form-text text-muted">Tutorial Actual Para {{ $maquina->nombre_maquina }}</p>
                    </div>
                </div>
            </div>

            <div class="form-group" id="div_foto">
                <label for="foto" class="ml-1 @error('video_up') text-danger @enderror">Video Tutorial</label>
                <input id="foto" name="video_up" type="file">
                @if($errors->has('video_up'))
                    <small class="text-danger ml-1" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('video_up') }}</small>
                @else
                    <small for="foto" class="form-text text-muted ml-1">Ingrese un archivo con formato: mp4 y que no sobrepase los 500 Megabytes.</small>
                @endif
            </div>
            <br/>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Modificar</button>
            </div>
        </form>
        <div class="mt-3">
            <a href="{{ route('tutoriales.show', $tutoriale) }}"><i class="fas fa-chevron-left"></i>&nbsp; Regresar</a>
        </div>
    </div>
    @error('video_up')
        <style>
            .file-caption{
                border-color: #dc3545;                
            }
        </style>
    @enderror
@endsection
