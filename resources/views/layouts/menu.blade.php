        <nav id="varn">
            <input type="checkbox" id="nav" class="hidden">
            <label for="nav" class="nav-btn">
                <i></i>
                <i></i>
                <i></i>
            </label>
            <div class="logo">
                <a id="machineLogo" href="/">MACHINE QR &nbsp;</a><a href="/"><i class="fas fa-qrcode text-dark"></i></a>
            </div>
            <div class="nav-wrapper">
                <ul>
                    <li><a href="/">Inicio</a></li>
                    <li><a href="{{ Request::root() }}/maquinas">Máquinas</a></li>
                    @auth
                        <li><a href="#">{{ Auth::user()->name }}</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-outline-danger btn-sm" type="submit">Cerrar Sesion</button>
                            </form>
                        </li>
                    @endauth
                    @guest
                        <li><a href="/login">Iniciar Sesión</a></li>
                    @endguest
                </ul>
            </div>
        </nav>
