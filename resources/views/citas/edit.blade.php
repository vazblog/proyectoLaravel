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
                            <h4 class="font-weight-bolder mt-1">Modificar Cita</h4>
                            <p class="mb-1 text-sm">Por favor, modifica la información de la cita.</p>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="{{ route('citas.update', $cita->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="input-group input-group-static mb-4">
                                    <label for="cliente_id">{{ __('Cliente') }}</label>
                                    <input id="cliente_id" type="text"
                                        class="form-control @error('cliente_id') is-invalid @enderror" name="cliente_id"
                                        value="{{ $cita->cliente->user->name }}" readonly>
                                    @error('cliente_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label for="fecha">{{ __('Fecha') }}</label>
                                    <input id="fecha" type="date"
                                        class="form-control @error('fecha') is-invalid @enderror" name="fecha"
                                        value="{{ date('Y-m-d', strtotime($cita->fecha_hora)) }}"
                                        min="{{ now()->format('Y-m-d') }}" required
                                        placeholder="Ingrese la fecha de la cita">
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
                                        value="{{ date('H:i', strtotime($cita->fecha_hora)) }}" min="09:00"
                                        max="20:00" required placeholder="Ingrese la hora de la cita">
                                    @error('hora')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group-static mb-4">
                                    <label for="tratamiento_id">{{ __('Tratamiento') }}</label>
                                    <select id="tratamiento_id"
                                        class="form-select @error('tratamiento_id') is-invalid @enderror"
                                        name="tratamiento_id" required>
                                        <option value="" disabled selected>Seleccione un tratamiento</option>
                                        @foreach ($tratamientos as $tratamiento)
                                            <option value="{{ $tratamiento->id }}"
                                                {{ $cita->tratamiento_id == $tratamiento->id ? 'selected' : '' }}>
                                                {{ $tratamiento->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('tratamiento_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class=" input-group-static mb-4">
                                    <label for="empleado_id">{{ __('Empleado') }}</label>
                                    <select id="empleado_id" class="form-select @error('empleado_id') is-invalid @enderror"
                                        name="empleado_id" required>
                                        <option value="" disabled selected>Seleccione un empleado</option>
                                        @foreach ($empleados as $empleado)
                                            @if ($empleado->rol_empleado != 'recepcionista')
                                                <option value="{{ $empleado->id }}">{{ $empleado->user->name }} -
                                                    {{ $empleado->rol_empleado }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('empleado_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label for="observaciones">{{ __('Observaciones') }}</label>
                                    <textarea id="observaciones" class="form-control @error('observaciones') is-invalid @enderror" name="observaciones"
                                        placeholder="Ingrese observaciones adicionales">{{ $cita->observaciones }}</textarea>
                                    @error('observaciones')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Guardar') }}
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
