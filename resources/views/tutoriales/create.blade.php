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
    <script src="{{ asset('js/crear-video.js') }}"></script>
@endpush

@section('cabecera')
<div class="container mt-sm-3 mt-md-3 mt-lg-5 mt-xl-5">
  <h2>Agregar Tutorial</h2>
  <p class="lead">Ingrese los siguientes datos para agregar un nuevo tutorial a {{ $maquina->nombre_maquina }}.</p>
</div>
@endsection

@section('contenido')
    <div class="container mt-3">
        <form autocomplete="off" id="form-general" method="POST" action="{{url('maquinas/' . $maquina->id . '/tutoriales')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nombre" class="ml-1 {{ ($errors->has('titulo')) ? 'text-danger' : '' }}">Título del tutorial</label>
                <input type="text" autocomplete="off" class="form-control {{ ($errors->has('titulo')) ? 'border border-danger' : '' }}" id="nombre" name="titulo" value="{{ old('titulo') }}">
                @if($errors->has('titulo'))
                    <small class="text-danger ml-2" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('titulo') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="descripcion" class="ml-1 {{ ($errors->has('descripcion')) ? 'text-danger' : '' }}">Descripción del video</label>
                <textarea class="form-control {{ ($errors->has('descripcion')) ? 'border border-danger' : '' }}" id="descripcion" name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
                @if($errors->has('descripcion'))
                    <small class="text-danger ml-2" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('descripcion') }}</small>
                @else
                    <small for="descripcion" class="form-text text-muted">Descripción completa del tutorial. Límite de caracteres: 1500.</small>
                @endif
            </div>
            @if(count($lists) > 0)
                <div class="form-group">
                    <label for="orden" class="ml-1 {{ ($errors->has('numero_orden')) ? 'text-danger' : '' }}">Posición del Tutorial</label>
                    <select class="form-control {{ ($errors->has('numero_orden')) ? 'border border-danger' : '' }}" id="orden" name="numero_orden">
                        @foreach($lists as $list)
                            @if($loop->first)
                                <option value="{{ $list->numero_orden }}" selected>El Primer Tutorial</option>
                            @endif
                            <option value="{{ $list->numero_orden + 1 }}">Después de {{ $list->titulo }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('numero_orden'))
                        <small class="text-danger ml-2" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('numero_orden') }}</small>
                    @endif
                </div>
            @else
                <input type="hidden" name="numero_orden" value="1"/>
            @endif
            <div class="form-group">
                <label for="foto" class="ml-1 {{ ($errors->has('video_up')) ? 'text-danger' : '' }}">Video Tutorial</label>
                <input id="foto" name="video_up" type="file" class="{{ ($errors->has('video_up')) ? 'border border-danger' : '' }}">

                @if($errors->has('video_up'))
                    <small class="text-danger ml-2" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('video_up') }}</small>
                @else
                    <small for="foto" class="form-text text-muted">Ingrese un archivo con formato: mp4 y que no sobrepase los 100000 kilobytes.</small>
                @endif
            </div>
            <br/>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
        </form>
        <div class="mt-5">
            <a href="{{ Request::root() }}/maquinas/{{$maquina->id}}/tutoriales"><i class="fas fa-chevron-left"></i>&nbsp; Regresar</a>
        </div>
    </div>
@endsection
