

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('imagenes/qrcode-logo.webp') }}" />
    <link rel="stylesheet" href = "{{ asset('css/bootstrap.min.css') }}" />
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/master.css') }}" rel="stylesheet">
    @stack('css')
    <title>Machine QR</title>
</head>

<body style="padding-top: 0rem;">

    <div id="overlay">
        <div style="position: absolute;top:40%;left: 48%;">
            <div  class="spinner-border text-primary" style="width: 4rem; height: 4rem;" role="status">
                <span class="sr-only">Loading...</span>

            </div>
            <!--<div class="mt-3" style="margin-left: -5%;">
                Cargando ...
            </div>-->
        </div>
    </div>

    <div id="cuerpo" style="display:none;">
        <header>
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
    </div>


    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/pageLoad.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/toasts.js') }}"></script>
    @stack('js')
</body>
</html>
