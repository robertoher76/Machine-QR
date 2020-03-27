<!--
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
                
                            <--<div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a> 
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
        -->

        <nav id="varn">
            <input type="checkbox" id="nav" class="hidden">
            <label for="nav" class="nav-btn">
                <i></i>
                <i></i>
                <i></i>
            </label>
            <div class="logo">
                <a href="#">MACHINE QR</a>
            </div>
            <div class="nav-wrapper">
                <ul>
                    <li><a href="#">Inicio</a></li>
                    <li><a href="{{ Request::root() }}/maquinas">Máquinas</a></li>                    
                    <li><a href="#">Daniela</a></li>
                    <li>
                        <form>      
                            <button class="btn btn-outline-danger btn-sm" type="submit">Cerrar Sesion</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>