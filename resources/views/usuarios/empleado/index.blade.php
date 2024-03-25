@extends('layouts.app')

@section('title', 'Cliente')
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

            @if (session('warning'))
                <div class="position-fixed top-50 start-50 translate-middle" style="z-index: 1050;">
                    <div class="toast fade show p-2 mx-auto mt-7" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-body text-center">
                            {{ session('warning') }}
                            <hr class="horizontal dark">
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn bg-gradient-warning btn-sm me-2 mb-0"
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
                        <h3 class="text-center">Empleados de BeautyZen</h3>
                    </div>
                </div>
            </div>

            <!-- Búsqueda -->
            <div class="container mt-2 mb-3">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-5 col-sm-6 col-8">
                        <form action="{{ route('usuarios.empleado.buscar') }}" method="GET">
                            <div class="input-group input-group-dynamic ">
                                <input class="form-control" name="search" placeholder="Introduzca el dni"
                                    type="text">
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
                <!-- Verifica si hay empleados -->
                @if ($empleados->isEmpty())
                    <div class="card">
                        <div class="card-body text-center">
                            <h4 class="card-title">No tienes Empleados</h4>
                            <p class="card-text">¡No hay empleados creadoss en este momento!</p>
                            <p class="card-text">¿Te gustaría crear un empleado?</p>
                            <a href="{{ route('usuarios.empleado.create') }}" class="btn btn-primary">Crear nueva cita</a>
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
                                                <th colspan="5">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h4 class="mb-0">Lista de Empleados</h4>
                                                        <a href="{{ route('usuarios.empleado.create') }}"><i
                                                                class="fa-solid fa-plus-circle fa-2xl" title="Crear cliente"
                                                                aria-label="Crear cliente"></i></a>
                                                    </div>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Nombre</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Apellidos</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    DNI</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Profesión</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($empleados as $empleado)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">

                                                            <div>
                                                                <img src="{{ !empty($empleado->user->photo) ? url('upload/admin_images/' . $empleado->user->photo) : url('upload/no_images.jpg') }}"
                                                                    class="avatar avatar-sm me-3">
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-xs">{{ $empleado->user->name }}</h6>
                                                            </div>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $empleado->user->apellido_uno }}
                                                            {{ $empleado->user->apellido_dos }}</p>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">{{ $empleado->user->DNI }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ ucfirst($empleado->rol_empleado) }}</p>
                                                    </td>

                                                    <td class="align-middle">
                                                        <div class="d-flex justify-content-around">

                                                            <!-- Enlace para ver detalles del empleado -->
                                                            <a href="{{ route('usuarios.empleado.show', $empleado->id) }}"
                                                                class="mb-0" title="Detalles" aria-label="Detalles">
                                                                <i class="fa-regular fa-address-card"></i>
                                                            </a>
                                                            <!-- Enlace para editar -->
                                                            <a href="{{ route('usuarios.empleado.edit', $empleado->id) }}"
                                                                class="mb-0" title="Editar" aria-label="Editar">
                                                                <i class="fa-regular fa-pen-to-square"></i>
                                                            </a>


                                                            <a href="{{ route('usuarios.empleado.destroy', $empleado->id) }}"
                                                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $empleado->id }}').submit();"
                                                                title="Eliminar" aria-label="Eliminar">
                                                                 <i class="fa-regular fa-trash-can"></i>
                                                             </a>
                                                             
                                                             <form id="delete-form-{{ $empleado->id }}"
                                                                   action="{{ route('usuarios.empleado.destroy', $empleado->id) }}"
                                                                   method="POST"
                                                                   style="display: none;">
                                                                 @csrf
                                                                 @method('DELETE')
                                                             </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="my-4">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination justify-content-center">
                                                <!-- Enlace "Anterior" -->
                                                <li
                                                    class="page-item me-1 {{ $empleados->onFirstPage() ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ $empleados->previousPageUrl() }}"
                                                        aria-label="Previous">
                                                        <span aria-hidden="true">&laquo;</span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                </li>

                                                <!-- Enlaces de las páginas -->
                                                @for ($i = 1; $i <= $empleados->lastPage(); $i++)
                                                    <li class="{{ $empleados->currentPage() == $i ? 'active' : '' }}">
                                                        <a class="page-link"
                                                            href="{{ $empleados->url($i) }}">{{ $i }}</a>
                                                    </li>
                                                @endfor

                                                <!-- Enlace "Siguiente" -->
                                                <li
                                                    class="page-item ms-1 {{ $empleados->hasMorePages() ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ $empleados->nextPageUrl() }}"
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


@endsection
