@extends('layouts.app')
@section('title', 'Citas')
@section('contenido')
    @php
        $mensaje = null;
    @endphp
    <section class="py-5 bg-gray-100">
        <div class="container">
            @if (session('success'))
                <div class="position-fixed top-50 start-50 translate-middle" style="z-index: 1050;">
                    <div class="toast fade show p-2 mx-auto mt-7" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-body text-center">
                            {{ session('success') }}
                            <hr class="horizontal dark">
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn bg-gradient-primary btn-sm me-2 mb-0"
                                    data-bs-dismiss="toast">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="position-fixed top-50 start-50 translate-middle" style="z-index: 1050;">
                    <div class="toast fade show p-2 mx-auto mt-7" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-body text-center">
                            {{ session('error') }}
                            <hr class="horizontal dark">
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn bg-gradient-danger btn-sm me-2 mb-0"
                                    data-bs-dismiss="toast">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="container align-self-center">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <h3 class="text-center">Citas de BeautyZen</h3>
                    </div>
                </div>
            </div>
            <!-- Búsqueda -->
            <div class="container mt-2 mb-3">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-5 col-sm-6 col-8">
                        <form action="{{ route('citas.buscar') }}" method="GET">
                            <div class="input-group input-group-dynamic ">
                                <input class="form-control" name="search" placeholder="Encuentra tu cita" type="text">
                                <button class="btn btn-primary" type="submit" style="margin-bottom: 0rem;">Buscar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            @if ($mensaje)
                <div class="container">
                    <div class="row">
                        <div class="col-12 py-3 my-auto">
                            <div class="toast fade show d-flex align-items-center justify-content-between bg-gradient-primary border-0 pe-2 mx-auto"
                                role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-body text-white">
                                    <i class="fa-regular fa-face-sad-tear me-2 fa-lg"></i> {{ $mensaje }}
                                </div>
                                <i class="fas fa-times text-md cursor-pointer pe-2 text-white" data-bs-dismiss="toast"
                                    aria-label="Close"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Verifica si hay citas -->
                @if ($citas->isEmpty())
                    <div class="card">
                        <div class="card-body text-center">
                            <h4 class="card-title">No tienes Citas</h4>
                            <p class="card-text">¡No hay citas creadas en este momento!</p>
                            <p class="card-text">¿Te gustaría crear una cita?</p>
                            <a href="{{ route('citas.create') }}" class="btn btn-primary">Crear nueva cita</a>
                        </div>
                    </div>
                @else
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                           
                                <div class="card">
                                    <div class="table-responsive">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr class="bg-gray-200">
                                                    <th colspan="6">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h4 class="mb-0">Lista de citas</h4>
                                                            @auth
                                                                @if (Auth::check() && Auth::user()->perfil)
                                                                    @if (Auth::user()->perfil->tipo === 'administrador' || Auth::user()->perfil->tipo === 'empleado')
                                                                        <a href="{{ route('citas.create') }}"><i
                                                                                class="fa-solid fa-plus-circle fa-2xl"
                                                                                title="Crear cita" aria-label="Crear cita"></i></a>
                                                                    @endif
                                                                @endif
                                                            @endauth
                                                        </div>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Fecha</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Hora</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Cliente</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Empleado</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Tratamiento</th>
                                                    @auth
                                                        @if (Auth::check() && Auth::user()->perfil)
                                                            @if (Auth::user()->perfil->tipo === 'administrador' || Auth::user()->perfil->tipo === 'empleado')
                                                                <th
                                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                                    Acciones</th>
                                                            @endif
                                                        @endif
                                                    @endauth
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($citas as $cita)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex px-2">
                                                                <div>
                                                                    <p class="text-xs font-weight-bold mb-0">
                                                                        {{ date('d/m/Y', strtotime($cita->fecha_hora)) }}</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ date('H:i', strtotime($cita->fecha_hora)) }}</p>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ $cita->cliente->user->name }}
                                                                {{ $cita->cliente->user->apellido_uno }}
                                                                {{ $cita->cliente->user->apellido_dos }}</p>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ $cita->empleado->user->name }}
                                                                {{ $cita->empleado->user->apellido_uno }}
                                                                {{ $cita->empleado->user->apellido_dos }} -
                                                                {{ $cita->empleado->rol_empleado }}</p>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ $cita->tratamiento->nombre }}
                                                            </p>
                                                        </td>
                                                        @auth
                                                            @if (Auth::check() && Auth::user()->perfil)
                                                                @if (Auth::user()->perfil->tipo === 'administrador' || Auth::user()->perfil->tipo === 'empleado')
                                                                    <td class="align-middle">
                                                                        <div class="d-flex justify-content-around">


                                                                            <!-- Enlace para editar -->
                                                                            <a href="{{ route('citas.edit', $cita->id) }}"
                                                                                class="mb-0" title="Editar"
                                                                                aria-label="Editar">
                                                                                <i class="fa-regular fa-pen-to-square"></i>
                                                                            </a>
                                                                            <!-- Enlace para eliminar -->
                                                                            <a href="#" class="mb-0 delete-product"
                                                                                data-toggle="modal"
                                                                                data-target="#confirmDeleteModal"
                                                                                data-product-id="{{ $cita->id }}"
                                                                                title="Eliminar" aria-label="Eliminar">
                                                                                <i class="fa-regular fa-trash-can"></i>
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                @endif
                                                            @endif
                                                        @endauth
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="my-4">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <!-- Enlace "Anterior" -->
                                                    <li class="page-item me-1 {{ $citas->onFirstPage() ? 'disabled' : '' }}">
                                                        <a class="page-link" href="{{ $citas->previousPageUrl() }}"
                                                            aria-label="Previous">
                                                            <span aria-hidden="true">&laquo;</span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                    </li>

                                                    <!-- Enlaces de las páginas -->
                                                    @for ($i = 1; $i <= $citas->lastPage(); $i++)
                                                        <li class="{{ $citas->currentPage() == $i ? 'active' : '' }}">
                                                            <a class="page-link"
                                                                href="{{ $citas->url($i) }}">{{ $i }}</a>
                                                        </li>
                                                    @endfor

                                                    <!-- Enlace "Siguiente" -->
                                                    <li class="page-item ms-1 {{ $citas->hasMorePages() ? 'disabled' : '' }}">
                                                        <a class="page-link" href="{{ $citas->nextPageUrl() }}"
                                                            aria-label="Next">
                                                            <span aria-hidden="true">&raquo;</span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </section>

    <!-- Modal de confirmación de eliminación -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
        aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que quieres eliminar esta cita?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn bg-gradient-dark mb-0" data-dismiss="modal">Cancelar</button>
                    @if (isset($cita))
                        <form id="deleteForm" action="{{ route('citas.destroy', $cita) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn bg-gradient-primary mb-0">Eliminar</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
