@extends('layouts.app')
@section('title', 'Tratamientos')
@section('contenido')
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
            <div class="container">
                <div class="row">
                    <div class="col-md-7 mx-auto text-center">
                        <h3>Tratamientos de BeautyZen</h3>
                    </div>
                </div>
                <!-- Búsqueda -->
                <div class="container mt-2 mb-3">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-5 col-sm-6 col-8">
                            <form action="{{ route('tratamientos.buscar') }}" method="GET">
                                <div class="input-group input-group-dynamic ">
                                    <input class="form-control" name="search" placeholder="Introduzca el nombre"
                                        type="text">
                                    <button class="btn btn-primary" type="submit"
                                        style="margin-bottom: 0rem;">Buscar</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        @unless (isset($tratamientos) && count($tratamientos) > 0)
                            <div class="container">
                                <div class="row">
                                    <div class="col-12  py-3 my-auto">
                                        <div class="toast fade show d-flex align-items-center justify-content-between bg-gradient-primary border-0 pe-2 mx-auto"
                                            role="alert" aria-live="assertive" aria-atomic="true">
                                            <div class="toast-body text-white">
                                                <i class="fa-regular fa-face-sad-tear me-2 fa-lg"></i> No se encontraron
                                                tratamientos.
                                            </div>
                                            <i class="fas fa-times text-md cursor-pointer pe-2 text-white"
                                                data-bs-dismiss="toast" aria-label="Close"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr class="bg-gray-200">
                                                <th colspan="5">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h4 class="mb-0">Lista de tratamientos</h4>
                                                        @auth
                                                            @if (Auth::check() && Auth::user()->perfil && Auth::user()->perfil->tipo === 'administrador')
                                                                <a href="{{ route('tratamientos.create') }}"><i
                                                                        class="fa-solid fa-plus-circle fa-2xl"
                                                                        title="Crear tratamiento"
                                                                        aria-label="Crear tratamiento"></i></a>
                                                            @endif
                                                        @endauth
                                                    </div>
                                                </th>
                                            </tr>

                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Nombre</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Descripción</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Precio</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Duración</th>
                                                @auth
                                                    @if (Auth::check() && Auth::user()->perfil && Auth::user()->perfil->tipo === 'administrador')
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Acciones
                                                        </th>
                                                    @endif
                                                @endauth

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tratamientos as $tratamiento)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2">
                                                            <div>
                                                                <h6 class="mb-0 text-xs">{{ $tratamiento->nombre }}</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">{{ $tratamiento->descripcion }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">{{ $tratamiento->precio }} €
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">{{ $tratamiento->duracion }}'
                                                        </p>
                                                    </td>
                                                    @auth
                                                        @if (Auth::check() && Auth::user()->perfil && Auth::user()->perfil->tipo === 'administrador')
                                                            <td class="align-middle">
                                                                <div class="d-flex justify-content-around">

                                                                    <!-- Enlace para editar -->
                                                                    <a href="{{ route('tratamientos.edit', $tratamiento->id) }}"
                                                                        class="mb-0" title="Editar" aria-label="Editar">
                                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                                    </a>


                                                                    <!-- Enlace para eliminar -->
                                                                    <a href="{{ route('tratamientos.destroy', $tratamiento->id) }}"
                                                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $tratamiento->id }}').submit();"
                                                                        title="Eliminar" aria-label="Eliminar">
                                                                        <i class="fa-regular fa-trash-can"></i>
                                                                    </a>

                                                                    <form id="delete-form-{{ $tratamiento->id }}"
                                                                        action="{{ route('tratamientos.destroy', $tratamiento->id) }}"
                                                                        method="POST" style="display: none;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                    </form>

                                                                </div>
                                                            </td>
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
                                                <li
                                                    class="page-item me-1 {{ $tratamientos->onFirstPage() ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ $tratamientos->previousPageUrl() }}"
                                                        aria-label="Previous">
                                                        <span aria-hidden="true">&laquo;</span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                </li>

                                                <!-- Enlaces de las páginas -->
                                                @for ($i = 1; $i <= $tratamientos->lastPage(); $i++)
                                                    <li class="{{ $tratamientos->currentPage() == $i ? 'active' : '' }}">
                                                        <a class="page-link"
                                                            href="{{ $tratamientos->url($i) }}">{{ $i }}</a>
                                                    </li>
                                                @endfor

                                                <!-- Enlace "Siguiente" -->
                                                <li
                                                    class="page-item ms-1 {{ $tratamientos->hasMorePages() ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ $tratamientos->nextPageUrl() }}"
                                                        aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                @endunless
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

@endsection
