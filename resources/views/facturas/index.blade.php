@extends('layouts.app')
@section('title', 'Facturas')
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
                        <h3 class="text-center">Facturas de BeautyZen</h3>
                    </div>
                </div>
            </div>
            <!-- Búsqueda -->
            <div class="container mt-2 mb-3">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-5 col-sm-6 col-8">
                        <form action="{{ route('facturas.buscar') }}" method="GET">
                            <div class="input-group input-group-dynamic ">
                                <input class="form-control" name="search" placeholder="Introduzca el dni" type="text">
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
                <!-- Verifica si hay facturas y clientes asociados -->

                @if (
                    $facturas->isEmpty() ||
                        $facturas->filter(function ($factura) {
                                return $factura->cliente;
                            })->isEmpty())

                    <div class="card">
                        <div class="card-body text-center">
                            <h4 class="card-title">No tienes facturas</h4>
                            <p class="card-text">¡No hay facturas creadas en este momento!</p>
                            <p class="card-text">¿Te gustaría crear una factura?</p>
                            <a href="{{ route('facturas.create') }}" class="btn btn-primary">Crear nueva factura</a>
                        </div>
                    </div>
                @else
                    <div class="row justify-content-center mt-4">
                        <div class="col-lg-10">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr class="bg-gray-200">
                                                <th colspan="6">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h4 class="mb-0">Lista de facturas</h4>
                                                        <a href="{{ route('facturas.create') }}"><i
                                                                class="fa-solid fa-plus-circle fa-2xl" title="Crear factura"
                                                                aria-label="Crear factura"></i></a>
                                                    </div>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Cliente</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    DNI</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Fecha de Emisión</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($facturas as $factura)
                                                @if ($factura->cliente)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex px-2">
                                                                <div>
                                                                    <h6 class="mb-0 text-xs">
                                                                        {{ $factura->cliente->user->name }}
                                                                        {{ $factura->cliente->user->apellido_uno }}
                                                                        {{ $factura->cliente->user->apellido_dos }}</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ $factura->cliente->user->DNI }}</p>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ date('d/m/Y', strtotime($factura->fecha_emision)) }}</p>
                                                        </td>
                                                        <td class="align-middle">
                                                            <div class="d-flex justify-content-around">
                                                                <a href="{{ route('facturas.show', $factura->id) }}"
                                                                    class="mb-0" title="Ver" aria-label="Ver factura">
                                                                    <i class="fa-solid fa-print"></i>
                                                                </a>

                                                                <!-- Enlace para eliminar -->
                                                                <a href="{{ route('facturas.destroy', $factura->id) }}"
                                                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $factura->id }}').submit();"
                                                                    title="Eliminar" aria-label="Eliminar">
                                                                    <i class="fa-regular fa-trash-can"></i>
                                                                </a>

                                                                <form id="delete-form-{{ $factura->id }}"
                                                                    action="{{ route('facturas.destroy', $factura->id) }}"
                                                                    method="POST" style="display: none;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </section>

@endsection
