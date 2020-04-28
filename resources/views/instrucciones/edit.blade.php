@extends('..layouts.plantilla')

@section('cabecera')
    <div class="container mt-sm-3 mt-md-3 mt-lg-5 mt-xl-5">
        <h2 class="text-body">Modificar {{ $instruccion->titulo }} <small style="font-size:18px;" class="text-muted">&nbsp; Última modificación {{ $instruccion->updated_at->format('d-m-Y') }}.</small></h2>
        <p class="lead">Modifique los siguientes campos para realizar cambios en la Instrucción.</p>
    </div>
@endsection

@section('contenido')
<div class="container mt-2">
    @if($errors->has('error'))
        @include('..layouts.toastDanger', ['title' => 'Advertencia', 'error' => $errors->first('error')])
    @elseif($errors->has('success'))
        @include('..layouts.toastSuccess', ['title' => 'Exitosamente', 'success' => $errors->first('success')])
    @endif
    <form autocomplete="off" id="form-general" method="POST" action="{{ route('instrucciones.update', $instruccion) }}">
        @method('PUT')
        @csrf       
        <div class="form-group">
            <label for="titulo" class="ml-1 @error('titulo') text-danger @enderror">Título de la Instrucción</label>
            <input type="text" autocomplete="off" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ (old('titulo') == null) ? $instruccion->titulo : old('titulo') }}">
            @error('titulo')
                <small class="text-danger ml-1" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="instrucciones_tipo_id " class="ml-1 @error('instrucciones_tipo_id') text-danger @enderror">Tipo de Instrucción</label>
            <select class="form-control @error('instrucciones_tipo_id') is-invalid @enderror" id="instrucciones_tipo_id" name="instrucciones_tipo_id">
                @foreach ($instrucciones_tipo as $tipo)
                    @if($instruccion->instrucciones_tipo_id == $tipo->id)
                        <option value="{{ $tipo->id }}" selected>{{ $tipo->nombre }}</option>
                    @else
                        <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                    @endif
                @endforeach
            </select>
            @error('instrucciones_tipo_id')
                <small class="text-danger ml-1" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $message }}</small>
            @enderror
          </div>
        <div class="form-group">
            <label for="descripcion" class="ml-1 @error('descripcion') text-danger @enderror">Descripción de la Instrucción</label>
            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3">{{ (old('descripcion') == null) ? $instruccion->descripcion : old('descripcion') }}</textarea>
            @if($errors->has('descripcion'))
                <small class="text-danger ml-2" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $errors->first('descripcion') }}</small>
            @else
                <small for="descripcion" class="form-text text-muted ml-1">Descripción completa de la Instrucción. Límite de caracteres: 1500.</small>
            @endif
        </div>
        @if(count($lists) > 0)
            <div class="form-group">
                <label for="orden" class="ml-1 @error('numero_orden') text-danger @enderror">Posición de la Introducción</label>
                <select class="form-control @error('numero_orden') is-invalid @enderror" id="orden" name="numero_orden">
                    @foreach($lists as $list)
                        @if($loop->iteration >= $instruccion->numero_orden)
                            @if($instruccion->numero_orden != 1 && $loop->first)
                                <option value="{{ $list->numero_orden }}">La Primera Instrucción</option>
                            @endif
                            @if($instruccion->numero_orden == $list->numero_orden)
                                <option value="{{ $list->numero_orden }}" selected>Mantener Posición</option>
                            @elseif($instruccion->numero_orden-1 != $list->numero_orden)
                                <option value="{{ $list->numero_orden }}">Después de {{ $list->titulo }}</option>
                            @endif
                        @else
                            @if($instruccion->numero_orden != 1 && $loop->first)
                                <option value="{{ $list->numero_orden }}">La primera Instrucción</option>
                            @endif
                            @if($instruccion->numero_orden-1 != $list->numero_orden)
                                <option value="{{ $list->numero_orden + 1 }}">Después de {{ $list->titulo }}</option>
                            @endif
                        @endif
                    @endforeach
                </select>
                @error('numero_orden')
                    <small class="text-danger ml-2" style="font-size:14px;"><i class="fas fa-exclamation-circle" style="font-size:12px !important;"></i> {{ $message }}</small>
                @endif
            </div>
        @else
            <input type="hidden" name="numero_orden" value="1"/>
        @endif
        <br/>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Modificar</button>
        </div>
    </form>
    <div class="mt-5">
        <a href="{{ route('maquinas.instrucciones.index', $maquina) }}"><i class="fas fa-chevron-left"></i>&nbsp; Regresar</a>
    </div>
</div>
@endsection
