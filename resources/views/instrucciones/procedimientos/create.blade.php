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
    <h2 style="color: black;">Agregar Procedimiento</h2>
    <p class="lead">Ingrese los siguientes datos para registrar un nuevo procedimiento a la instrucción {{ $instruccione->titulo }}.</p>
</div>
@endsection

@section('contenido')
<div class="container mt-4">
    <form autocomplete="off" id="form-general" method="POST" action="{{url('/maquinas/instrucciones/'.$instruccione->id.'/procedimientos')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="descripcion" class="ml-1 {{ ($errors->has('descripcion')) ? 'text-danger' : '' }}">Descripción del Procedimiento</label>
            <textarea class="form-control {{ ($errors->has('descripcion')) ? 'border border-danger' : '' }}" id="descripcion" name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
            @if($errors->has('descripcion'))
                <small class="text-danger ml-2" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('descripcion') }}</small>
            @else
                <small for="descripcion" class="form-text text-muted">Descripción completa del procedimiento a realizar. Límite de caracteres: 1500.</small>
            @endif
        </div>
        @if(count($lists) > 0)
            <div class="form-group">
                <label for="orden" class="ml-1 {{ ($errors->has('numero_orden')) ? 'text-danger' : '' }}">Posición del Procedimiento</label>
                <select class="form-control {{ ($errors->has('numero_orden')) ? 'border border-danger' : '' }}" id="orden" name="numero_orden">
                    @foreach($lists as $list)
                        @if($loop->first)
                            <option value="{{ $list->numero_orden }}" selected>El primer procedimiento</option>
                        @endif
                        <option value="{{ $list->numero_orden + 1 }}">Después del procedimiento #{{ $list->numero_orden }}</option>
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
            <label for="foto" class="ml-1 {{ ($errors->has('foto_up')) ? 'text-danger' : '' }}">Imagen del Procedimiento</label>
            <input id="foto" name="foto_up" type="file" class="{{ ($errors->has('foto_up')) ? 'border border-danger' : '' }}">
            @if($errors->has('foto_up'))
                <small class="text-danger ml-2" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('foto_up') }}</small>
            @else
                <small for="foto" class="form-text text-muted">Ingrese un archivo con formato: jpg, jpeg o png y que no sobrepase los 4000 kilobytes.</small>
            @endif
        </div>
        <br/>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
    </form>
    <div class="mt-4">
        <a href="{{ Request::root() }}/maquinas/{{$instruccione->maquina_id}}/instrucciones/{{$instruccione->id}}"><i class="fas fa-chevron-left"></i>&nbsp; Regresar</a>
    </div>
</div>

@endsection
