@extends('layouts.plantillaInicio')

@section('contenido')

  <div class="overflow-hidden vh-100 position-absolute" style="top: 0;">
    
    <div class="pt-3 px-3 pt-md-5 col-sm-12 col-md-12 col-lg-7 px-md-5 text-center overflow-hidden position-relative" style="top: 10%;z-index: 10;">
      <div class="my-3 p-3 ml-lg-6 mr-lg-5">
        <h1 class="display-5" style="color: #2977c9;">MACHINE QR</h1>
        <p class="lead mt-4 text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a purus non odio tincidunt interdum. Ut dapibus, nisl sed tempor gravida, augue erat cursus mi, id cursus est diam non lorem.</p>
        <p class="lead text-justify">Integer maximus turpis ut quam blandit, vitae vulputate dui interdum. Sed eleifend nec magna et mattis.</p>        
      </div>      
    </div>
    
    <div class="position-absolute" style="right: 5%;bottom: 5%;z-index: 1;">
      <img src="{{ asset('imagenes/machine-icon-png-6.png') }}" height="475px"/>
    </div>

  </div>

  <div class="container d-md-flex flex-md-equal w-100 my-md-3 pl-md-3" style="width: 100%;margin-top: 100vh!important;">

    <div class="mr-md-3 px-3 px-md-5 w-50 text-center overflow-hidden" style="margin:auto!important;">
      <div class="my-3 p-3">
        <h1 class="display-5">MACHINE QR</h1>
        <p class="lead">La ingenieria desde tu smartphone.</p>
      </div>
      <div class="bg-dark shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;">      
        <img src="{{ asset('imagenes/qrcode3.gif') }}" class="w-100 p-3 pt-5" style="border-radius: 10% 10% 0 0;" alt="Flowers in Chania">
      </div>
    </div>

  </div>


  <div class="row d-md-flex flex-md-equal w-100">    
    <div class="pt-3 px-3 pt-md-5 col-sm-12 col-md-12 col-lg-7 px-md-5 text-center overflow-hidden">
      <div class="my-3 p-3 ml-lg-5 mr-lg-5">
        <h2 class="display-5" style="color: #2977c9;">¿Qué es MACHINE QR?</h2>
        <p class="lead mt-4 text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a purus non odio tincidunt interdum. Ut dapibus, nisl sed tempor gravida, augue erat cursus mi, id cursus est diam non lorem.</p>
        <p class="lead text-justify">Integer maximus turpis ut quam blandit, vitae vulputate dui interdum. Sed eleifend nec magna et mattis.</p>
      </div>      
    </div>
    <div class="pt-3 px-3 pt-md-3 col-sm-12 col-md-12 col-lg-5 px-md-5 text-center overflow-hidden">
      <div class="my-3 py-3 align-self-center text-center">
        <img src="{{ asset('imagenes/machine-icon-png-6.png') }}" style="height: 300px;"/>
      </div>      
    </div>
  </div>

  <div class="position-relative overflow-hidden p-3 p-md-5 text-center">
    <div class="col-md-6 mx-auto my-5">
      <h1 class="display-4 font-weight-normal">Mejorar Machine QR</h1>
      <p class="lead font-weight-normal">And an even wittier subheading to boot. Jumpstart your marketing efforts with this example based on Apple’s marketing pages.</p>
      <a class="btn btn-outline-secondary" href="#">Iniciar Sesión</a>
    </div>   
  </div>
@endsection