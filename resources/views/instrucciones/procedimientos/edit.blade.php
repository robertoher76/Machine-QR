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
    <div class="container mt-5">
        <h2 style="color: black;">Modificar Procedimiento #{{ $procedimiento->numero_orden }}
            <small style="font-size:18px;" class="text-muted">&nbsp; Última modificación {{ $procedimiento->updated_at->format('d-m-Y') }}.</small>
    </h2>
  <p class="lead">Ingrese los siguientes datos para modificar el procedimiento de la instrucción {{ $instruccione->titulo }}.</p>
</div>
@endsection

@section('contenido')

<div class="container mt-4">
    <form autocomplete="off" id="form-general" method="POST" action="{{url('/maquinas/instrucciones/'.$instruccione->id.'/procedimientos/'.$procedimiento->id)}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <input type="hidden" name="instruccione_id" value="{{ $instruccione->id }}">
        <div class="form-group">
            <label for="descripcion" class="ml-1 {{ ($errors->has('descripcion')) ? 'text-danger' : '' }}">Descripción del Procedimiento</label>
            <textarea class="form-control {{ ($errors->has('descripcion')) ? 'border border-danger' : '' }}" id="descripcion" name="descripcion" rows="3">{{ (old('descripcion') != null) ? old('descripcion') : $procedimiento->descripcion }}</textarea>
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
                        @if($loop->iteration >= $procedimiento->numero_orden)
                            @if($procedimiento->numero_orden != 1 && $loop->first)
                                <option value="{{ $list->numero_orden }}">El primer procedimiento</option>
                            @endif
                            @if($procedimiento->numero_orden == $list->numero_orden)
                                <option value="{{ $list->numero_orden }}" selected>Mantener Posición</option>
                            @elseif($procedimiento->numero_orden-1 != $list->numero_orden)
                                <option value="{{ $list->numero_orden }}">Después del procedimiento #{{ $list->numero_orden }}</option>
                            @endif
                        @else
                            @if($procedimiento->numero_orden != 1 && $loop->first)
                                <option value="{{ $list->numero_orden }}">El primer procedimiento</option>
                            @endif
                            @if($procedimiento->numero_orden-1 != $list->numero_orden)
                                <option value="{{ $list->numero_orden + 1 }}">Después del procedimiento #{{ $list->numero_orden }}</option>
                            @endif
                        @endif
                    @endforeach
                </select>
                @if($errors->has('numero_orden'))
                    <small class="text-danger ml-2" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('numero_orden') }}</small>
                @endif
            </div>
        @else
            <input type="hidden" name="numero_orden" value="1"/>
        @endif
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="modificarIMG" name="cambiarImagen" value="falso">
            <label class="form-check-label" for="modificarIMG">Cambiar imagen del Componente</label>
        </div>
        <div class="form-group text-center" id="imagenActual">
            <a class="example-image-link" href="{{ asset('storage/imagenes/procedimientos/' . $procedimiento->imagen) }}" data-lightbox="example-set" data-title="Imagen actual para Procedimiento #{{ $procedimiento->numero_orden }}"><img class="example-image mt-3 ml-1 mr-1" style="border-radius: 2%;" widht="100%;" height="300px;" src="{{ asset('storage/imagenes/procedimientos/' . $procedimiento->imagen) }}"/></a>
            <br/>
            <p class="form-text text-muted">Imagen Actual para Procedimiento #{{ $procedimiento->numero_orden  }}</p>
        </div>
        <div class="form-group" id="div_foto">
            <label for="foto" class="ml-1 {{ ($errors->has('foto_up')) ? 'text-danger' : '' }}">Imagen del Procedimiento</label>
            <input id="foto" name="foto_up" type="file" class="{{ ($errors->has('foto_up')) ? 'border border-danger' : '' }}">
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
</div>
@endsection
