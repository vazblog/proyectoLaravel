@extends('layouts.app')
@section('title', 'Citas')
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

            @if ($errors->any())
                <div class="position-fixed top-50 start-50 translate-middle" style="z-index: 1050;">
                    <div class="toast fade show p-2 mx-auto mt-7" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-body text-center">
                            <ul class="text-start">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <hr class="horizontal dark">
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn bg-gradient-danger btn-sm me-2 mb-0"
                                    data-bs-dismiss="toast">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif



            <div class="row">
                <div class="col-xl-6 col-lg-7 col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="font-weight-bolder mt-1">Crear Nueva Cita</h4>
                            <p class="mb-1 text-sm">Por favor, ingresa la información solicitada para crear una nueva cita.
                            </p>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('citas.store') }}">
                                @csrf

                                <div class="input-group input-group-static mb-4">
                                    <label for="nombre_cliente">{{ __('Nombre del Cliente') }}</label>
                                    <input id="nombre_cliente" type="text"
                                        class="form-control @error('nombre_cliente') is-invalid @enderror"
                                        name="nombre_cliente" value="{{ old('nombre_cliente') }}" required
                                        placeholder="Ingrese el nombre del cliente">
                                    @error('nombre_cliente')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label for="dni_cliente">{{ __('DNI del Cliente') }}</label>
                                    <input id="dni_cliente" type="text"
                                        class="form-control @error('dni_cliente') is-invalid @enderror" name="dni_cliente"
                                        value="{{ old('dni_cliente') }}" required placeholder="Ingrese el DNI del cliente">
                                    @error('dni_cliente')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label for="fecha">{{ __('Fecha') }}</label>
                                    <input id="fecha" type="date"
                                        class="form-control @error('fecha') is-invalid @enderror" name="fecha"
                                        value="{{ old('fecha') }}" min="{{ now()->format('Y-m-d') }}" required>
                                    @error('fecha')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label for="hora">{{ __('Hora') }}</label>
                                    <input id="hora" type="time"
                                        class="form-control @error('hora') is-invalid @enderror" name="hora"
                                        value="{{ old('hora') }}" min="09:00" max="20:00" required>
                                    @error('hora')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group-static mb-4 ">

                                    <label for="tratamiento">{{ __('Tratamiento') }}</label>
                                    <select id="tratamiento" class="form-select  @error('tratamiento') is-invalid @enderror"
                                        name="tratamiento" required>
                                        <option value="" disabled selected>Seleccione un tratamiento</option>
                                        @foreach ($tratamientos as $tratamiento)
                                            <option value="{{ $tratamiento->id }}">{{ $tratamiento->nombre }}</option>
                                        @endforeach
                                    </select>

                                    @error('tratamiento')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group-static mb-4">
                                    <label for="empleado">{{ __('Empleado') }}</label>
                                    <select id="empleado" class="form-select @error('empleado') is-invalid @enderror"
                                        name="empleado" required>
                                        <option value="" disabled selected>Seleccione un empleado</option>
                                        @foreach ($empleados as $empleado)
                                            @if ($empleado->rol_empleado != 'recepcionista')
                                                <option value="{{ $empleado->id }}">{{ $empleado->user->name }} -
                                                    {{ $empleado->rol_empleado }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('empleado')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label for="observaciones">{{ __('Observaciones') }}</label>
                                    <textarea id="observaciones" class="form-control @error('observaciones') is-invalid @enderror" name="observaciones"
                                        placeholder="Ingrese observaciones adicionales">{{ old('observaciones') }}</textarea>
                                    @error('observaciones')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" id="registroButton">
                                        {{ __('Crear') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
