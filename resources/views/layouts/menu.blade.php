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
