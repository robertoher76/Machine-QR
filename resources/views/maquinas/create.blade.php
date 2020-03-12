@extends('..layouts.plantilla')


@section('cabecera')
<div class="container mt-5">
<h1 style="color: black;">Agregar Máquina</h1>
<p class="lead">Ingrese los siguientes datos para registrar una nueva máquina a la aplicación.</p>
</div>
@endsection

@section('contenido')
    <div class="container mt-5">
      <form autocomplete="off" method="POST" action="{{url('/maquinas')}}">
        @csrf
        <div class="form-group">
          <label for="nombre">Nombre de la Máquina</label>
          <input type="text" autocomplete="off" class="form-control" id="nombre" name="nombre">
    
        </div>
        <div class="form-group mb-5">
          <label for="descripcion">Funcionamiento de la Máquina</label>
          <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
          <small id="descripcion" class="form-text text-muted">Descripción completa del funcionamiento de la máquina. Límite de caracteres: 600</small>
        </div> 
  
        <button type="submit" class="btn btn-primary">Registrar</button>
      </form>
    </div>
@endsection