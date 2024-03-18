@extends('layouts.app')

@section('title', 'Cliente')

@section('contenido')
    <div class="container py-4">
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




        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6">
                <div class="card card-profile">
                    <div
                        class="card-header text-center mt-n4 mx-3 p-0 bg-transparent position-relative z-index-2 miFondo py-2">
                        <a class="d-block blur-shadow-image">
                            <img src="{{ !empty($cliente->user->photo) ? url('upload/admin_images/' . $cliente->user->photo) : url('upload/no_images.jpg') }}"
                                alt="img-blur-shadow" class="img-fluid avatar avatar-xxl rounded-circle">
                        </a>
                    </div>
                    <div class="card-body text-center">

                        <h4 class="card-title">{{ $cliente->user->name }}
                            {{ $cliente->user->apellido_uno }} {{ $cliente->user->apellido_dos }}</h4>

                        @if ($cliente->user->perfil->tipo == 'empleado')
                            <p>{{ $cliente->user->empleado->rol_empleado }}</p>
                        @endif
                        <div class="row justify-content-center text-start border-top pt-2">
                            <div class="col-lg-12 col-12">
                                <p class="mt-0">Dni: {{ $cliente->user->DNI }}</p>
                                <p class="mt-0">Fecha de
                                    nacimiento:{{ date('d/m/Y', strtotime($cliente->user->fecha_nac)) }}</p>
                                <p class="mt-0">Email: {{ $cliente->user->email }}</p>
                                <p class="mt-0">Teléfono: {{ $cliente->user->telefono }}</p>
                                <p class="mt-0">Dirección: {{ $cliente->user->direccion }}</p>
                                <p class="mt-0">Código Postal: {{ $cliente->user->cp }}</p>
                                <p class="mt-0">Población: {{ $cliente->user->poblacion }}</p>
                                <p class="mt-0">Suscrito a newsletter: {{ $cliente->suscripcion === 'S' ? 'Sí' : 'No' }}
                                </p>

                                @if ($cliente->user->perfil->tipo == 'empleado')
                                    <p class="mt-0">Rol de Empleado: {{ $cliente->user->empleado->rol_empleado }}</p>
                                @endif
                            </div>

                        </div>
                        <a href="{{ route('usuarios.cliente.edit', ['id' => $cliente->id]) }}"
                            class="btn btn-primary">Modificar</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
