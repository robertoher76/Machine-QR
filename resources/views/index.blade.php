@extends('layouts.plantillaInicio')

@push('css')
  <link href="{{ asset('css/inicio.css') }}" rel="stylesheet">
@endpush

@section('contenido')

  <div class="overflow-hidden vh-100 position-relative" style="top: 0;">
    
    <div class="pt-3 px-3 pt-md-3 col-sm-12 col-md-12 col-lg-7 px-md-5 overflow-hidden position-relative">
      <div id="tituloCover" class="my-3 p-2 ml-lg-6 mr-lg-5">
        <h1 class="display-4 font-weight-normal" style="color: #2977c9;">Compartiendo la ingeniería al mundo</h1>
        <p class="lead mt-4 text-justify">
          MACHINE QR es una herramienta para el conocimiento de máquinas y equipos usados en las prácticas de ingeniería de la Universidad Don Bosco.
        </p>
        <p class="lead text-justify">Accede a nuestra aplicación para conocer sus funcionamiento, componentes, instructivos y tutoriales.</p>        
        <div>
          <a href="{{ route('maquinas.index') }}" class="btn btn-outline-primary">Acceder</a>
        </div>       
      </div>      
    </div>    
    <div id="imgCover" class="position-absolute">
      <img src="{{ asset('imagenes/machine-icon-png-6.png') }}"/>
    </div>

  </div>

  <div id="scannImg" class="container d-md-flex flex-md-equal w-100 my-md-3 pl-md-3" style="width: 100%;">

    <div class="mr-md-3 px-3 px-md-5 w-md-100 w-lg-50 text-center overflow-hidden" style="margin:auto!important;">
      <div class="my-3 p-3">
        <h1 class="display-5">MACHINE QR APP</h1>
        <p class="lead">La ingenieria desde tu smartphone, ¡descarga la app ahora!.</p>
      </div>
      <div class="bg-dark shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;">      
        <img src="{{ asset('imagenes/qrcode3.gif') }}" class="w-100 p-3 pt-5" style="border-radius: 10% 10% 0 0;" alt="Flowers in Chania">
      </div>
    </div>
  </div>
  <!--
  <div class="position-relative overflow-hidden p-3 p-md-5 text-center">
    <div class="col-md-6 mx-auto my-5">
      <h1 class="display-4 font-weight-normal">Mejora Machine QR</h1>
      <p class="lead font-weight-normal">And an even wittier subheading to boot. Jumpstart your marketing efforts with this example based on Apple’s marketing pages.</p>
      <a class="btn btn-outline-secondary" href="login">Iniciar Sesión</a>
    </div>   
  </div>
  -->
@endsection