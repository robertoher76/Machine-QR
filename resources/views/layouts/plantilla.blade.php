<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href = "{{ asset('css/bootstrap.min.css') }}" />
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/master.css') }}" rel="stylesheet">
    @stack('css')
    <title>Machine QR</title>
</head>
<body style="padding-top: 0rem;">
    <header >

    @include('..layouts.menu')

    </header>

    <main role="main">
        <div class="cabecera">
            @yield("cabecera")
        </div>

        <div class="contenido">
            @yield("contenido")
        </div>

        <div class="pie mt-5">
            <footer class="text-muted">
                <div class="container">
                    <p>&copy; 2020 Machine QR | Todos los derechos reservados.</p>
                </div>
            </footer>
        </div>

    </main>


    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/toasts.js') }}"></script>
    @stack('js')
</body>
</html>
