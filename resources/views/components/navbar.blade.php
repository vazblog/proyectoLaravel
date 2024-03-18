<nav class="navbar navbar-expand-lg navbar-light   py-3">
    <div class="container-fluid">

        <a class="navbar-brand" rel="tooltip" title="enlace BeautyZen"
            data-placement="bottom">
            BeautyZen
        </a>

        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </span>
        </button>


        <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0" id="navigation">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item mx-2">
                    <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center"
                        aria-current="page" href="{{ url('/') }}">Inicio</a>
                </li>

                <li class="nav-item mx-2">

                    <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center"
                        aria-current="page" href="{{ url('/quienes') }}">Quiénes somos</a>
                </li>

                <li class="nav-item dropdown dropdown-hover">
                    <a class="nav-link active dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Servicios
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('servicios.tratamientos') }}">Tratamientos</a></li>
                        <li><a class="dropdown-item" href="{{ route('servicios.depilacion') }}">Depilación</a></li>
                        <li><a class="dropdown-item" href="{{ route('servicios.esteticos') }}">Estéticos</a></li>                        
                    </ul>
                </li>
                @guest 
                <li class="nav-item mx-2">

                    <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center"
                        aria-current="page" href="{{ route('productos-estaticos') }}">Productos</a>
                </li>
                @endguest

                <li class="nav-item mx-2">

                    <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center"
                        aria-current="page" href="{{ url('/cita') }}">Cita</a>
                </li>


                <li class="nav-item mx-2">

                    <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center"
                        aria-current="page" href="{{ url('/contacto') }}">Contacto</a>
                </li>

                @if (auth()->check())
                    <li class="nav-item">
                        <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center"
                            aria-current="page" href="{{ url('/') }}" data-bs-toggle="modal"
                            data-bs-target="#confirmLogoutModal">Logout</a>
                    </li>
                @else

                    <li class="nav-item">
                        <a class="nav-link ps-2 d-flex  cursor-pointer align-items-center" 
                            aria-current="page" href="{{ route('login') }}"><i
                                class="far fa-user me-2"></i> Acceder</a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>





