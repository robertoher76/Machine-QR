<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href = "{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href = "{{ asset('css/carousel.css') }}" />
    <link rel="stylesheet" href = "{{ asset('css/lightbox.min.css') }}" />
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <title>Machine QR</title>
</head>
<body style="padding-top: 0rem;">
    <header >
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Machine QR</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
      
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                    </li>            
                    <li class="nav-item ml-1 dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Máquinas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Lista de Máquinas</a>
                            <a class="dropdown-item" href="#">Nueva Máquina</a>
                
                            <!--<div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a> -->
                        </div>
                    </li>                    
                    <li class="nav-item ml-1 dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Roberto
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Perfil</a>
                            <a class="dropdown-item" href="#">Administrar Usuarios</a>
                
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Datos eliminados</a>
                        </div>
                    </li>   
                    
                    <li class="nac-item">
                    <form class="form-inline my-2 my-lg-0">      
                        <button class="btn btn-outline-danger ml-2 my-2 my-sm-0" type="submit">Cerrar Sesion</button>
                    </form>
                    </li>
                </ul>
                
            </div>
      </nav>
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
    <script src="{{ asset('js/jquery-3.4.1.slim.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/lightbox-plus-jquery.min.js') }}"></script>
</body>
</html>