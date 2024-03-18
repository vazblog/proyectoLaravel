@extends('layouts.app')
@section('title', 'Facturas')
@section('contenido')
    <section class="py-5 bg-gray-100">
        <div class="container">

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
            <!-- Contenido de la factura -->
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <p><strong>Nº Factura:</strong> {{ $factura->id }}</p>
                            <p><strong>Fecha de Emisión:</strong> {{ date('d M Y', strtotime($factura->fecha_emision)) }}
                            </p>
                        </div>
                        <div class="card-body">
                            <!-- Mostrar nombre de la empresa y su logo -->
                            <div class="text-center mb-4 border-bottom pb-3">
                                <img src="{{ asset('images/beautyzencorto.svg') }}" alt="Logo de la Empresa"
                                    style="max-width: 150px;">
                                <h3>BeautyZen</h3>
                            </div>

                            <!-- Tabla de Información del Cliente -->
                            <div class="table-responsive ">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr class="bg-gray-200">
                                            <div class="d-flex justify-content-start ">
                                                <h5 class="mb-2">Información del cliente </h5>

                                            </div>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Nombre:</strong> {{ $factura->cliente->user->name }}</td>

                                        </tr>
                                        <tr>
                                            <td><strong>Apellidos:</strong> {{ $factura->cliente->user->apellido_uno }}
                                                {{ $factura->cliente->user->apellido_dos }}</td>

                                        </tr>
                                        <tr>
                                            <td><strong>DNI:</strong> {{ $factura->cliente->user->DNI }}</td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Tabla de Detalles del Tratamiento -->
                            <div class="table-responsive mt-4">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-gray-200">
                                            <div class="d-flex justify-content-start border-bottom">
                                                <h5 class="mb-2">Detalles tratamiento</h5>

                                            </div>
                                        </tr>
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Duración (minutos)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $factura->tratamiento->nombre }}</td>
                                            <td>{{ $factura->tratamiento->precio }} €</td>
                                            <td>{{ $factura->tratamiento->duracion }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Tabla de Detalles de la Factura -->
                            <div class="table-responsive mt-4">
                                <div class="d-flex justify-content-start border-bottom">
                                    <h5 class="mb-2">Detalles de productos</h5>

                                </div>
                                <table class="table table-striped table-bordered">
                                    <thead>

                                        <tr>
                                            <th scope="col">Producto</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($factura->productos as $producto)
                                            @if ($producto->pivot->cantidad_producto > 0)
                                                <tr>
                                                    <td>{{ $producto->nombre }}</td>
                                                    <td>{{ $producto->precio }}</td>
                                                    <td>{{ $producto->pivot->cantidad_producto }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Detalles de la Factura -->
                            <div class="row mt-4 border-top py-3 text-end">
                                <div class="col-md-12">
                                    <p><strong>Subtotal:</strong> {{ $factura->total_factura }} €</p>
                                    <p><strong>IVA:</strong> {{ $iva * 100 }}%</p>
                                    <p><strong>Total de la Factura:</strong> {{ $totalFacturaConIva }} €</p>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button class="btn btn-primary" onclick="window.print()">Imprimir Factura</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
@endsection
