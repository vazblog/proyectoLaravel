@extends('layouts.app')

@section('title', 'Administrador')

@section('contenido')
    <section class="py-5 bg-gray-100">
        <div class="container">

            <!-- Mensajes de éxito y error -->
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
                        <h3 class="text-center">Administradores de BeautyZen</h3>
                    </div>
                </div>
            </div>

            <!-- Búsqueda -->
            <div class="container mt-2 mb-3">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-5 col-sm-6 col-8">
                        <form action="{{ route('usuarios.administrador.buscar') }}" method="GET">
                            <div class="input-group input-group-dynamic">
                                <input class="form-control" name="search" placeholder="Introduzca el dni"
                                    type="text">
                                <button class="btn btn-primary" type="submit" style="margin-bottom: 0rem;">Buscar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    @unless (isset($administradores) && count($administradores) > 0)
                        <div class="container">
                            <div class="row">
                                <div class="col-12  py-3 my-auto">
                                    <div class="toast fade show d-flex align-items-center justify-content-between bg-gradient-primary border-0 pe-2 mx-auto"
                                        role="alert" aria-live="assertive" aria-atomic="true">
                                        <div class="toast-body text-white">
                                            <i class="fa-regular fa-face-sad-tear me-2 fa-lg"></i> No se encontraron
                                            administradores.
                                        </div>
                                        <i class="fas fa-times text-md cursor-pointer pe-2 text-white" data-bs-dismiss="toast"
                                            aria-label="Close"></i>
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
                                                    <h4 class="mb-0">Lista de administradores</h4>
                                                    <a href="{{ route('usuarios.administrador.create') }}">
                                                        <i class="fa-solid fa-plus-circle fa-2xl" title="Crear administrador"
                                                            aria-label="Crear administrador"></i>
                                                    </a>
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nombre</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Apellidos</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                DNI</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Dirección</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($administradores as $administrador)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">
                                                        <div class="d-flex px-2 py-1">

                                                            <div>
                                                                <img src="{{ !empty($administrador->photo) ? url('upload/admin_images/' . $administrador->photo) : url('upload/no_images.jpg') }}"
                                                                    class="avatar avatar-sm me-3">

                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-xs">{{ $administrador->name }}</h6>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $administrador->apellido_uno }}
                                                        {{ $administrador->apellido_dos }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $administrador->DNI }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $administrador->direccion }}</p>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex justify-content-around">
                                                        <!-- Enlace para ver detalles del administrador -->
                                                        <a href="{{ route('usuarios.administrador.show', $administrador->id) }}"
                                                            class="mb-0" title="Detalles" aria-label="Detalles">
                                                            <i class="fa-regular fa-address-card"></i>
                                                        </a>
                                                        <!-- Enlace para editar -->
                                                        <a href="{{ route('usuarios.administrador.edit', $administrador->id) }}"
                                                            class="mb-0" title="Editar" aria-label="Editar">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </a>
                                                        <!-- Enlace para eliminar -->
                                                        <a href="{{ route('usuarios.administrador.destroy', $administrador->id) }}"
                                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $administrador->id }}').submit();"
                                                            title="Eliminar" aria-label="Eliminar">
                                                             <i class="fa-regular fa-trash-can"></i>
                                                         </a>
                                                         
                                                         <form id="delete-form-{{ $administrador->id }}"
                                                               action="{{ route('usuarios.administrador.destroy', $administrador->id) }}"
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
                                <!-- Paginación -->
                                <div class="my-4">
                                    {{ $administradores->links() }}
                                </div>
                            </div>
                        </div>
                    @endunless
                </div>
            </div>
        </div>
    </section>

@endsection
