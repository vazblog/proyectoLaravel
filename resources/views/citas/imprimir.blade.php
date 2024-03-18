@extends('layouts.app')
@section('title', 'Facturas')
@section('contenido')
    <section class="py-5 bg-gray-100">
        <div class="container">
            <!-- Contenido de la factura -->
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <p><strong>Nº Cita:</strong> {{ $cita->id }}</p>
                        </div>
                        <div class="card-body">
                            <!-- Mostrar nombre de la empresa y su logo -->
                            <div class="text-center mb-4 border-bottom pb-3">
                                <img src="{{ asset('images/beautyzencorto.svg') }}" alt="Logo de la Empresa"
                                    style="max-width: 150px;">
                                <h3>BeautyZen</h3>
                            </div>


                            <div class="text-center mb-4 border-bottom pb-3">
                                <p><em> Estimado cliente, agradecemos su puntualidad para la cita. Su <strong>colaboración</strong> es
                                    fundamental para garantizar una atención eficiente. <strong>¡Gracias!</strong></em>
                                </p>
                            </div>
                            

                            <!-- Tabla de Detalles de la Cita -->
                            <div class="table-responsive mt-4">
                                <div class="d-flex justify-content-start border-bottom">
                                    <h5 class="mb-2">Detalles de la cita</h5>
                                </div>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td> <strong>Empleado:</strong>
                                                {{ $cita->empleado->user->name }} {{ $cita->empleado->user->apellido_uno }}
                                                {{ $cita->empleado->user->apellido_dos }}</td>
                                        </tr>
                                        <tr>
                                            <td> <strong>Fecha:</strong>
                                                {{ \Carbon\Carbon::parse($cita->fecha_hora)->format('d/m/Y') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <strong>Hora:</strong>
                                                <!-- Mantenemos el formato de la hora -->
                                                {{ \Carbon\Carbon::parse($cita->fecha_hora)->format('H:i') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                            <td><strong>Nombre:</strong> {{ $cita->cliente->user->name }}</td>

                                        </tr>
                                        <tr>
                                            <td><strong>Apellidos:</strong> {{ $cita->cliente->user->apellido_uno }}
                                                {{ $cita->cliente->user->apellido_dos }}</td>

                                        </tr>
                                        <tr>
                                            <td><strong>DNI:</strong> {{ $cita->cliente->user->DNI }}</td>

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
                                            <td>{{ $cita->tratamiento->nombre }}</td>
                                            <td>{{ $cita->tratamiento->precio }} €</td>
                                            <td>{{ $cita->tratamiento->duracion }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>



                        </div>

                        <div class="card-footer">
                            <button class="btn btn-primary" onclick="window.print()">Imprimir Cita</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
@endsection
