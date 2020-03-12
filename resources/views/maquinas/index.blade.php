@extends('..layouts.plantilla')



@section('cabecera')
<div class="container mt-5">
<h1 style="color: black;">Listado de Máquinas &nbsp;<a href="{{ Request::url() }}/create" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Nueva Máquina</a></h1>
<p class="lead">Número de Máquinas: {{ $num_maquina }}</p>

</div>
@endsection


@section('contenido')

<div class="album mt-4">
    <div class="container">

      <div class="row">

        @foreach ($maquinas as $maquina)
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
                      
              <img width="100%" height="225" src="{{ asset('imagenes/maquinas/'. $maquina->imagen) }}"/>

            <div class="card-body">
              <h4 class="card-title">{{ $maquina->nombre_maquina }}</h4>
              <p class="card-text">{{ $maquina->descripcion }}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="maquinas/{{ $maquina->id }}" class="btn btn-sm btn-outline-secondary">Ver más</a>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Editar</button>
                </div>
                <small class="text-muted">Editado {{ $maquina->updated_at->format('d-m-Y') }}</small>
              </div>
            </div>
          </div>
        </div>
        @endforeach

        <!--

        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
            <div class="card-body">
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="1" class="btn btn-sm btn-outline-secondary">View</a>
                  <a class="btn btn-sm btn-outline-secondary">Edit</a>
                </div>
                <small class="text-muted">9 mins</small>
              </div>
            </div>
          </div>
        </div>
        
        -->

      </div>
    </div>
  </div>


@endsection