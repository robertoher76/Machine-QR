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
            <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9 mt-lg-1 mt-xl-1">
                <div class="w-100 mb-2">
                    <h2 class="text-body d-flex flex-wrap">{{ $maquina->nombre_maquina }} &nbsp;
                    <td>
                        <form method="POST" action="{{ route('maquinas.destroy', $maquina) }}">
                            <a href="{{ route('maquinas.edit', $maquina) }}" class="btn btn-outline-success btn-sm"><i class="far fa-edit"></i> Modificar</a>
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-outline-danger btn-sm" type="submit"><i class="far fa-trash-alt"></i> Eliminar</button>
                        </form>
                    </td>
                    </h2>
                </div>
                <div class="w-100">
                    <p style="font-size: 19px;" class="lead text-justify mt-3">{{ $maquina->descripcion}}</p>
                </div>
                <br/>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3 align-self-center text-center pr-0 pt-0">
                <a class="example-image-link" data-title="QR Actual para {{ $maquina->nombre_maquina }}" href="{{ asset('storage/imagenes/QR/' . $maquina->codigo_qr . '.png') }}" data-lightbox="example-1"><img class="example-image ml-1 mr-1 rounded" widht="100%;" height="200px;" src="{{ asset('storage/imagenes/QR/' . $maquina->codigo_qr . '.png') }}"/></a>
                <small class="text-muted form-text">Click sobre el QR para ampliarla.</small>
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
                <div class="mt-4">
                    <h5 class="text-body">Componentes de {{ $maquina->nombre_maquina }} &nbsp;<a href="{{ route('maquinas.componentes.create', $maquina) }}" class="btn btn-outline-success btn-sm"><i class="far fa-plus-square"></i> Agregar</a></h5>
                    @if($componentes->total() > 0)
                        <div class="row mt-4">
                            @foreach ($componentes as $componente)
                                <div class="card mt-1 mr-1 ml-1 mb-2" style="width: 21rem;">
                                    <a class="example-image-link" data-title="{{ $componente->nombre }}" href="{{ asset('storage/imagenes/componentes/' . $componente->imagen) }}" data-lightbox="componente-{{ $componente->id }}"><img class="example-image" width="100%" height="228px" src="{{ asset('storage/imagenes/componentes/' . $componente->imagen) }}"/></a>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $componente->nombre }}</h5>
                                        <p class="card-text mb-5 text-justify"> {{ $componente->descripcion }} </p>
                                        <div class="btn-group mb-3 position-absolute" style="bottom:0;">
                                            <a href="{{ route('componentes.edit', $componente) }}" class="btn btn-sm btn-outline-secondary">Ver más</a>
                                            <a href="{{ route('componentes.show', $componente) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($componentes->total() > 6)
                            <div class="container mt-3 text-center">
                                <a href="{{ route('maquinas.componentes.index', $maquina) }}">Ver más Componentes</i></a>
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
                <div class="mt-4">
                    <h5 class="text-body">Instrucciones de {{ $maquina->nombre_maquina }} &nbsp;<a href="{{ route('maquinas.instrucciones.create', $maquina) }}" class="btn btn-outline-success btn-sm"><i class="far fa-plus-square"></i> Agregar</a></h5>
                    @if($instrucciones->total() > 0)
                        @foreach ($instrucciones as $instruccion)
                            <div class="card mt-4">
                                <div class="card-header">
                                    Tipo de Instrucción: {{ $instruccion->nombre }}
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $instruccion->titulo }}</h5>
                                    <p class="card-text">{{ $instruccion->descripcion }}</p>
                                    <a href="{{ route('instrucciones.show', $instruccion) }}" class="btn btn-primary btn-sm">Ver más</a>
                                </div>
                            </div>
                        @endforeach
                        @if($instrucciones->total() > 6)
                            <div class="container mt-5 text-center">
                                <a href="{{ route('maquinas.instrucciones.index', $maquina) }}">Ver más Instrucciones</i></a>
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
                <div class="mt-4">
                    <h5 class="text-body">Tutoriales de {{ $maquina->nombre_maquina }} &nbsp;
                        <a href="{{ route('maquinas.tutoriales.create', $maquina) }}" class="btn btn-outline-success btn-sm"><i class="far fa-plus-square"></i> Agregar</a>
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
                                        <div class="btn-group mb-3 position-absolute" style="bottom:0;">
                                            <a href="{{ route('tutoriales.show', $tutorial->id) }}" class="btn btn-sm btn-outline-secondary">Ver más</a>
                                            <a href="{{ route('tutoriales.edit', $tutorial->id) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @if($tutoriales->total() > 6)
                            <div class="container mt-5 text-center">
                                <a href="{{ route('maquinas.tutoriales.index', $maquina) }}">Ver más Tutoriales</i></a>
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
                <div class="mt-4">
                    <h5 class="text-body">Galería de {{ $maquina->nombre_maquina }}
                        &nbsp;
                        <a href="{{ route('maquinas.galeria.create', $maquina) }}" class="btn btn-outline-success btn-sm"><i class="far fa-plus-square"></i> Agregar</a>
                    </h5>
                </div>
                @if($galerias->total()>0)
                    <div>
                        @foreach ($galerias as $imagen)
                            <a class="example-image-link" href="{{ asset('storage/imagenes/galeria/' . $imagen->imagen) }}" data-lightbox="example-set" data-title="{{ $imagen->descripcion }}"><img class="example-image mt-3 ml-1 mr-1 rounded" widht="100%;" height="200px;" src="{{ asset('storage/imagenes/galeria/' . $imagen->imagen) }}"/></a>
                        @endforeach                        
                        <div class="container mt-5 text-center">
                            <a href="{{ route('maquinas.galeria.index', $maquina) }}"><i class="far fa-images"></i> Ver más fotos de la Galería</a>
                        </div>
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
                <div>
                    <h5>Imagen Actual para {{ $maquina->nombre_maquina }} &nbsp;
                        <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#exampleModalCenter"><i class="far fa-edit"></i>
                            Modificar Imagen
                        </button>
                    </h5>
                    @include('..layouts.modal', ['title' => 'Cambiar Imagen de '.$maquina->nombre_maquina, 'icon1' => 'fas fa-upload', 'icon2' => 'far fa-images', 'title2' => 'Subir Imagen', 'title3' => 'Escoger de Galería'])
                </div>
                <div class="col-12 mt-3 text-center">
                    <a class="example-image-link" data-title="Imagen Actual para {{ $maquina->nombre_maquina }}" href="{{ asset('storage/imagenes/maquinas/' . $maquina->imagen) }}" data-lightbox="example-2"><img class="example-image mt-4 ml-1 mr-1 rounded" widht="100%;" height="250px;" src="{{ asset('storage/imagenes/maquinas/' . $maquina->imagen) }}"/></a>
                    <small class="form-text text-muted">Click sobre la imagen para ampliarla.</small>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <div class="container mt-4">
        <a href="{{ route('maquinas.index') }}"><i class="fas fa-chevron-left"></i>&nbsp; Regresar</a>
    </div>
</div>
@endsection
