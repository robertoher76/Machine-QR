@extends('..layouts.plantilla')


@section('cabecera')
<div class="container mt-5">
<h1 style="color: black;">Agregar Nuevo Componente</h1>
<p class="lead">Ingrese los siguientes datos para registrar un nuevo componente a la máquina.</p>
</div>
@endsection

@section('contenido')
    <div class="container mt-5">
      <form autocomplete="off" method="POST" action="{{url('/maquinas')}}">
        @csrf
        <div class="form-group">
          <label for="nombre">Nombre del Componente</label>
          <input type="text" autocomplete="off" class="form-control" id="nombre" name="nombre">
    
        </div>
        <div class="form-group mb-5">
          <label for="descripcion">Descripción del Componente</label>
          <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
          <small id="descripcion" class="form-text text-muted">Descripción completa del funcionamiento del componente.</small>
        </div> 
  
        <button type="submit" class="btn btn-primary">Registrar</button>
      </form>
    </div>
@endsection