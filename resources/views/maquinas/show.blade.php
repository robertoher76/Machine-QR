@extends('..layouts.plantilla')

@push('css')
<link rel="stylesheet" href = "{{ asset('css/carousel.css') }}" />
    <link rel="stylesheet" href = "{{ asset('css/lightbox.min.css') }}" />
    <link rel="stylesheet" href = "{{ asset('css/show.css') }}" />
@endpush

@push('js')
<script src="{{ asset('js/lightbox-plus-jquery.min.js') }}"></script>
<script src="{{ asset('js/lightbox-config.js') }}"></script>
@endpush

@section('cabecera')
    <div class="container mt-sm-0 mt-md-3 mt-lg-5 mt-xl-5">
        @if($errors->has('error'))
            @include('..layouts.toastDanger', ['title' => 'Advertencia', 'error' => $errors->first('error')])
        @elseif($errors->has('success'))
            @include('..layouts.toastSuccess', ['title' => 'Exitosamente', 'success' => $errors->first('success')])
        @endif
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <div class="mb-2" style="width:100% !important;">
                    <h1 style="color:black;">{{ $maquina->nombre_maquina }} &nbsp;
                    <a href="{{ Request::url() }}/edit" class="btn btn-outline-success btn-sm"><i class="far fa-edit"></i> Editar</a>
                    <a href="{{ Request::url() }}/edit" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Eliminar</a>
                </div>
                <div style="width:100% !important;">
                    <p class="lead text-justify mt-3">{{ $maquina->descripcion}}</p>
                </div>
                <br/>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 align-self-center text-center pr-0 pt-0">
                <a class="example-image-link" data-title="QR Actual para {{ $maquina->nombre_maquina }}" href="{{ asset('storage/imagenes/QR/' . $maquina->codigo_qr . '.png') }}" data-lightbox="example-1"><img class="example-image ml-1 mr-1" style="border-radius: 2%;" widht="100%;" height="200px;" src="{{ asset('storage/imagenes/QR/' . $maquina->codigo_qr . '.png') }}"/></a>
                <small class="form-text text-muted">Click sobre el QR para ampliarla.</small>
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
            <a class="nav-item nav-link" id="nav-perfil-tab" data-toggle="tab" href="#nav-perfil" role="tab" aria-controls="nav-perfil" aria-selected="false">Foto Principal</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="container">
                <div class="container mt-4">
                    <h5 class="text-dark">Componentes de {{ $maquina->nombre_maquina }} &nbsp;&nbsp;<a href="{{ Request::root() }}/maquinas/{{ $maquina->id }}/componente/create" class="btn btn-outline-success btn-sm"><i class="far fa-plus-square"></i> Agregar</a></h5>

                    @if($componentes->count() > 0)
                        <div class="row mt-4">
                            @foreach ($componentes as $componente)
                                <div class="card mt-1 mr-1 ml-1 mb-2" style="width: 21rem;">

                                    <a class="example-image-link" data-title="{{ $componente->nombre }}" href="{{ asset('storage/imagenes/componentes/' . $componente->imagen) }}" data-lightbox="componente-{{ $componente->id }}"><img class="example-image" width="100%" height="228px" src="{{ asset('storage/imagenes/componentes/' . $componente->imagen) }}"/></a>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $componente->nombre }}</h5>
                                        <p class="card-text mb-5" style="text-align:justify;"> {{ $componente->descripcion }} </p>
                                        <div class="btn-group mb-3" style="bottom:0;position:absolute;">
                                            <a href="{{ Request::url() }}/componente/{{ $componente->id }}" class="btn btn-sm btn-outline-secondary">Ver más</a>
                                            <a href="{{ Request::url() }}/componente/{{ $componente->id }}/edit" class="btn btn-sm btn-outline-secondary">Editar</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($componentes->total() > 6)
                            <div class="container mt-5 text-center">
                                <a href="{{ Request::url() }}/componente" class="btn btn-outline-info rounded-pill">Ver más componentes ...</i></a>
                            </div>
                        @endif
                    @else
                        <div class="display-1 mt-sm-1 mt-md-4 mt-lg-4 mt-xl-4">
                            <div class="display-1 text-center">
                                <i class="far fa-folder-open"></i>
                            </div>
                            <div class="display-1 text-center">
                            <h4>No posee Componentes</h4>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="container">
                <div class="container mt-4">
                <h5 class="text-dark">Instrucciones de {{ $maquina->nombre_maquina }} &nbsp;<a href="{{ Request::root() }}/maquinas/{{ $maquina->id }}/instrucciones/create" class="btn btn-outline-success btn-sm"><i class="far fa-plus-square"></i> Agregar</a></h5>
                    @if($instrucciones->total() > 0)
                        @foreach ($instrucciones as $instruccion)
                            <div class="card mt-4">
                                <div class="card-header">
                                    Tipo de Instrucción: {{ $instruccion->nombre }}
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $instruccion->titulo }}</h5>
                                    <p class="card-text">{{ $instruccion->descripcion }}</p>
                                    <a href="{{ Request::url() }}/instrucciones/{{ $instruccion->id }}" class="btn btn-primary btn-sm">Ver más</a>
                                </div>
                            </div>
                        @endforeach
                        @if($instrucciones->total() > 6)
                            <div class="container mt-5 text-center">
                                <a href="{{ Request::url() }}/instruccion" class="btn btn-outline-info rounded-pill">Ver más instrucciones ...</i></a>
                            </div>
                        @endif
                    @else
                        <div class="display-1 mt-sm-1 mt-md-4 mt-lg-4 mt-xl-4">
                            <div class="display-1 text-center">
                                <i class="far fa-folder-open"></i>
                            </div>
                            <div class="display-1 text-center">
                                <h4>No posee Instrucciones</h4>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <div class="container">
                <div class="container mt-4">
                    <h5 class="text-dark">Tutoriales de {{ $maquina->nombre_maquina }} &nbsp;
                        <a href="{{ Request::root() }}/maquinas/tutoriales/create" class="btn btn-outline-success btn-sm"><i class="far fa-plus-square"></i> Agregar</a>
                        <a href="{{ Request::url() }}/edit" class="btn btn-outline-primary btn-sm"><i class="far fa-edit"></i> Modificar</a>
                    </h5>
                    @if($tutoriales->total() > 0)
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
                        @if($tutoriales->total() > 6)
                            <div class="container mt-5 text-center">
                                <a href="{{ Request::url() }}/tutorial" class="btn btn-outline-info rounded-pill">Ver más tutoriales ...</i></a>
                            </div>
                        @endif
                    @else
                        <div class="display-1 mt-sm-1 mt-md-4 mt-lg-4 mt-xl-4">
                            <div class="display-1 text-center">
                                <i class="far fa-folder-open"></i>
                            </div>
                            <div class="display-1 text-center">
                            <h4>No posee Tutoriales</h4>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="nav-video" role="tabpanel" aria-labelledby="nav-video-tab">
            <div class="container">
                <div class="container mt-4">
                    <h5 class="text-dark">Galería de {{ $maquina->nombre_maquina }}

                    &nbsp;
                    <a href="{{ Request::url() }}/edit" class="btn btn-outline-success btn-sm"><i class="far fa-plus-square"></i> Agregar</a>
                    <a href="{{ Request::url() }}/edit" class="btn btn-outline-primary btn-sm"><i class="far fa-edit"></i> Modificar</a>
                    </h5>
                </div>
                @if($galerias->total()>0)
                    <div class="text-center">
                        @foreach ($galerias as $imagen)
                            <a class="example-image-link" href="{{ asset('storage/imagenes/galeria/' . $imagen->imagen) }}" data-lightbox="example-set" data-title="{{ $imagen->descripcion }}"><img class="example-image mt-3 ml-1 mr-1" style="border-radius: 2%;" widht="100%;" height="200px;" src="{{ asset('storage/imagenes/galeria/' . $imagen->imagen) }}"/></a>
                        @endforeach
                        @if($galerias->total()>15)
                            <div class="container mt-5 text-center">
                                <a href="{{ Request::url() }}/galeria" class="btn btn-outline-info rounded-pill">Ver más imagenes ...</i></a>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="display-1 mt-sm-1 mt-md-4 mt-lg-4 mt-xl-4">
                        <div class="display-1 text-center">
                            <i class="far fa-folder-open"></i>
                        </div>
                        <div class="display-1 text-center">
                            <h4>No posee Imagenes</h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="tab-pane fade" id="nav-perfil" role="tabpanel" aria-labelledby="nav-perfil-tab">
            <div class="container mt-4">
                <div class="text-center">
                    <h5>Imagen de {{ $maquina->nombre_maquina }} &nbsp;<a href="{{ Request::root() }}/maquinas/instrucciones/create" class="btn btn-outline-success btn-sm">Cambiar Imagen</a></h5>
                </div>
                <div class="col-12 mt-2 text-center">
                    <a class="example-image-link" data-title="Imagen Actual para {{ $maquina->nombre_maquina }}" href="{{ asset('storage/imagenes/maquinas/' . $maquina->imagen) }}" data-lightbox="example-2"><img class="example-image mt-3 ml-1 mr-1" style="border-radius: 2%;" widht="100%;" height="300px;" src="{{ asset('storage/imagenes/maquinas/' . $maquina->imagen) }}"/></a>
                    <small class="form-text text-muted">Click sobre la imagen para ampliarla.</small>
                </div>
            </div>
        </div>


    </div>
    <br/>
    <div class="container mt-5 text-center">
        <p>
            <a href="{{ Request::root() }}/maquinas">Regresar al listado de máquinas</a>
        </p>
    </div>

</div>
@endsection
