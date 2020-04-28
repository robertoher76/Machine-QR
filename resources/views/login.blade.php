@extends('layouts.plantillaInicio')

@push('css')
<link rel="stylesheet" href = "{{ asset('css/signin.css') }}" />
@endpush

@section('contenido')
    <form autocomplete="off" class="form-signin" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="text-center">
            <img class="mb-4" src="{{ asset('imagenes/qrcode-logo.webp') }}" alt="" width="72" height="72">

        </div>
        <h1 class="h3 mb-3 font-weight-normal text-center">Inicio Sesión</h1>
        <label for="inputEmail" class="sr-only">Nombre de Usuario</label>
        <input type="text" name="name" autocomplete="off" class="form-control" placeholder="Nombre de Usuario" value="{{ old('name') }}" required autofocus>
        <label for="inputPassword" class="sr-only">Contraseña</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
        <p class="mt-3 text-center mb-3 text-muted"><a href="">¿Has olvidado tu contraseña?</a></p>
    </form>
@endsection

