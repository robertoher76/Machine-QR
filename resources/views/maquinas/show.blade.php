@extends('..layouts.plantilla')

@section('cabecera')
    <div class="container mt-5">
        <div class="row">
            
            <div class="col-8">
                <h1>{{ $maquina->nombre_maquina }} &nbsp;<button type="button" class="btn btn-success btn-sm"><i class="far fa-edit"></i> Editar</button></h1>
                <p class="lead">{{ $maquina->descripcion}}</p>
                
                <br/>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModalCenter">
                <i class="fas fa-image"></i> Imagen de perfil
                </button>
                <!--<a class="example-image-link" href="{{ asset('imagenes/maquinas/' . $maquina->imagen) }}" data-lightbox="example-1" data-title="Imagen de perfil"><button type="button" class="btn btn-secondary">Ver imagen de perfil</button></a>
                -->

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Imagen de perfil de {{ $maquina->nombre_maquina }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <img src="{{ asset('storage/imagenes/maquinas/'. $maquina->imagen) }}" width="auto" height="300rem" alt="Responsive image">                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-success">Cambiar</button>
                        </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-4 mt-2 pr-0">
                <div class="text-center">
                    <img src="{{ asset('storage/imagenes/QR/' . $maquina->codigo_qr) }}" width="auto" height="175rem" alt="Responsive image">                
                    
                    
                </div>
            </div>
            
        </div>
    </div>
@endsection

@section('contenido')
<div class="container mt-5">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Componentes</a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Instructivos</a>
            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Tutoriales</a>
            <a class="nav-item nav-link" id="nav-video-tab" data-toggle="tab" href="#nav-video" role="tab" aria-controls="nav-video" aria-selected="false">Galería</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="container">
                <div class="mt-4">
                    <h5>Lista de componentes de {{ $maquina->nombre_maquina }} &nbsp;&nbsp;<a href="{{ Request::root() }}/maquinas/componentes/create" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Nuevo Componente</a></h5>
                </div>
                <div class="row mt-4">
                @foreach ($componentes as $componente)
                    <div class="card mt-2 mr-1 ml-1" style="width: 18rem;">
                        <img width="100%" height="215px" src="{{ asset('storage/imagenes/maquinas/'. $componente->imagen) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $componente->nombre }}</h5>
                            <p class="card-text mb-5" style="text-align:justify;"> {{ $componente->descripcion }} </p>
                            <div class="btn-group mb-3" style="bottom:0;position:absolute;">
                                <a href="{{ Request::root() }}/maquinas/componentes/{{ $componente->id }}" class="btn btn-sm btn-outline-secondary">Ver más</a>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Editar</button>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="container mt-2">
                <div class="mt-4">
                    <h5>Lista de instrucciones de {{ $maquina->nombre_maquina }} &nbsp;<a href="{{ Request::root() }}/maquinas/instrucciones/create" class="btn btn-success btn-sm">Nueva Instrucción</a></h5>
                </div>
                @foreach ($instrucciones as $instruccion)
                <div class="card mt-4">
                    <div class="card-header">
                        Tipo de Instrucción: {{ $instruccion->nombre }}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $instruccion->titulo }}</h5>
                        <p class="card-text">{{ $instruccion->descripcion }}</p>
                        <a href="{{ Request::root() }}/maquinas/instrucciones/{{ $instruccion->id }}" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
                @endforeach
            
            </div>
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">                

            <style>
                video {
                    width: 100%;
                    height: 300px;
                }
            </style>
            <div class="container">            
                <div class="mt-4">
                    <h5>Lista de Tutoriales de {{ $maquina->nombre_maquina }} &nbsp;<a href="{{ Request::root() }}/maquinas/tutoriales/create" class="btn btn-success btn-sm">Nuevo Tutorial</a></h5>
                </div>
            </div>
            <div class="row">

                @foreach ($tutoriales as $tutorial)
                <div class="col-sm-6 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <video  src="{{ asset('storage/tutoriales/' . $tutorial->video) }}" controls>
                                Tu navegador no implementa el elemento <code>video</code>.
                            </video>
                            <h5 class="card-title mt-2">{{ $tutorial->titulo }}</h5>
                            <p class="card-text mb-5"> {{ $tutorial->descripcion }} </p>
                            <div class="btn-group mb-3" style="bottom:0;position:absolute;">
                                <a href="{{ Request::root() }}/maquinas/tutoriales/{{ $tutorial->id }}" class="btn btn-sm btn-outline-secondary">Ver más</a>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Editar</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

        </div>
        <div class="tab-pane fade" id="nav-video" role="tabpanel" aria-labelledby="nav-video-tab">
        
            <div class="container">
                <div class="mt-4">
                    <h5>Galería de imagenes de {{ $maquina->nombre_maquina }} 
                    &nbsp;<a href="{{ Request::root() }}/maquinas/imagenes/" class="btn btn-success btn-sm">Modificar Galería</a>
                    </h5>
                </div>
                
                <div class="text-center">
                @foreach ($galeria as $imagen)
                
                <a class="example-image-link" href="{{ asset('imagenes/maquinas/' . $imagen->imagen) }}" data-lightbox="example-set" data-title="{{ $imagen->descripcion }}"><img class="example-image mt-3 ml-1 mr-1" style="border-radius: 2%;" widht="100%;" height="200px;" src="{{ asset('imagenes/maquinas/' . $imagen->imagen) }}"/></a>
                
                @endforeach

                </div>
                </div>

            </div>
        
        </div>
    </div>

    <div class="container mt-5 text-center">
        <p>
            <a href="{{ Request::root() }}/maquinas">Regresar al listado de máquinas</a>
        </p>
    </div>

</div>
@endsection
