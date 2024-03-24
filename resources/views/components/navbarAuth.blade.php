<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand">BeautyZen</a>
        <button id="nav-btn" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarDiv" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon mt-2" id="navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('dashboard.index') }}">Mi Panel</a>
                </li>

                <!-- Citas -->
                <li class="nav-item">
                    @auth
                        @php
                            $cliente = Auth::user()->cliente;
                            $clienteId = $cliente ? $cliente->id : null;
                        @endphp
                        @if ($clienteId)
                            <a class="nav-link active" aria-current="page" href="{{ route('citas.show', $clienteId) }}">Mis
                                Citas</a>
                        @else
                            <a class="nav-link active" aria-current="page" href="{{ route('citas.index') }}">Citas</a>
                        @endif
                    @endauth
                </li>
                @auth
                    @if (Auth::user()->perfil_id && Auth::user()->perfil)
                        @php
                            $perfil = Auth::user()->perfil;
                            $tipoPerfil = $perfil->tipo;
                            $rolEmpleado = Auth::user()->empleado ? Auth::user()->empleado->rol_empleado : null;
                        @endphp

                        <!-- Mostrar el rol del empleado si es un empleado -->
                        @if ($tipoPerfil === 'administrador' || ($tipoPerfil === 'empleado' && $rolEmpleado === 'recepcionista'))
                            <!-- Mostrar elementos de navegación específicos para recepcionistas -->
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page"
                                    href="{{ route('facturas.index') }}">Facturas</a>
                            </li>
                        @endif
                    @endif

                    <!-- Menú de Tratamientos -->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="{{ route('tratamientos.index') }}">Tratamientos</a>
                    </li>
                    <!-- Menú de Productos -->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('productos.index') }}">Productos</a>
                    </li>

                    <!-- Menú de Usuarios -->
                    @if ($tipoPerfil === 'administrador' || ($tipoPerfil === 'empleado' && $rolEmpleado === 'recepcionista'))
                        <li class="nav-item dropdown dropdown-hover">
                            <a class="nav-link active dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Usuarios
                            </a>
                            <ul class="dropdown-menu"  style="inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 34px, 0px);">
                                <!-- Opción de Administrador -->
                                @if ($tipoPerfil === 'administrador')
                                    <li><a class="dropdown-item"
                                            href="{{ route('usuarios.administrador.index') }}">Administrador</a></li>
                                @endif

                                <!-- Opción de Empleados (para administrador y recepcionista) -->
                                @if ($tipoPerfil === 'administrador' || ($tipoPerfil === 'empleado' && $rolEmpleado === 'recepcionista'))
                                    <li><a class="dropdown-item" href="{{ route('usuarios.empleado.index') }}">Empleados</a>
                                    </li>
                                @endif

                                <!-- Opción de Clientes (para administrador y recepcionista) -->
                                @if ($tipoPerfil === 'administrador' || ($tipoPerfil === 'empleado' && $rolEmpleado === 'recepcionista'))
                                    <li><a class="dropdown-item" href="{{ route('usuarios.cliente.index') }}">Clientes</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif


                    <!-- Perfil del Usuario -->
                    <li class="nav-item">
                        @auth
                            @php
                                $perfil = Auth::user()->perfil;
                                $tipoPerfil = $perfil ? $perfil->tipo : null;
                                $perfilId = null;

                                // Verificamos si el tipo de perfil está configurado correctamente
                                if ($tipoPerfil) {
                                    // Accedemos al ID del perfil de manera segura dependiendo del tipo de perfil
                                    switch ($tipoPerfil) {
                                        case 'cliente':
                                            $perfilId = Auth::user()->cliente ? Auth::user()->cliente->id : null;
                                            break;
                                        case 'administrador':
                                            $perfilId = Auth::id(); // El ID del usuario es suficiente para los administradores
                                            break;
                                        case 'empleado':
                                            $perfilId = Auth::user()->empleado ? Auth::user()->empleado->id : null;
                                            break;
                                        default:
                                            break;
                                    }
                                }
                            @endphp

                            <!-- Verificamos si tenemos un ID de perfil válido antes de mostrar el enlace -->
                            @if ($perfilId)
                                <a class="nav-link active" aria-current="page"
                                    href="{{ route('usuarios.' . $tipoPerfil . '.show', ['id' => $perfilId]) }}">Mi Perfil</a>
                            @endif
                        @endauth
                    </li>

                @endauth


                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#" data-bs-toggle="modal"
                        data-bs-target="#confirmLogoutModal">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="confirmLogoutModal" tabindex="-1" aria-labelledby="confirmLogoutModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmLogoutModalLabel">¿Estás seguro de que quieres salir?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="{{ route('logout') }}" class="btn btn-primary">Salir</a>
            </div>
        </div>
    </div>
</div>

<script>
    // Collapse or expand navigation when toggler button is clicked
    $('.navbar-toggler').on('click', function() {
        var $navbarCollapse = $('.navbar-collapse');

        if ($navbarCollapse.hasClass('show')) {
            // Si el menú está abierto, lo replegamos
            $navbarCollapse.collapse('hide');
        } else {
            // Si el menú está cerrado, lo desplegamos
            $navbarCollapse.collapse('show');
        }
    });
</script>
