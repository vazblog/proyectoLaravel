@extends('layouts.app')

@section('title', 'Cliente')

@section('contenido')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6">
                <div class="card card-profile">
                    <div
                        class="card-header text-center mt-n4 mx-3 p-0 bg-transparent position-relative z-index-2 miFondo py-2">
                        <a class="d-block blur-shadow-image">
                            <img src="{{ !empty($empleado->user->photo) ? url('upload/admin_images/' . $empleado->user->photo) : url('upload/no_images.jpg') }}"
                                alt="img-blur-shadow" class="img-fluid avatar avatar-xxl rounded-circle  border shadow">
                        </a>
                    </div>
                    <div class="card-body text-center">

                        <h4 class="card-title">{{ $empleado->user->name }}
                            {{ $empleado->user->apellido_uno }} {{ $empleado->user->apellido_dos }}</h4>

                        @if ($empleado->user->perfil->tipo == 'empleado')
                            <p> {{ ucfirst($empleado->rol_empleado) }}</p>
                        @endif
                        <div class="row justify-content-center text-start border-top pt-2">
                            <div class="col-lg-12 col-12">
                                <p class="mt-0">Dni: {{ $empleado->user->DNI }}</p>
                                <p class="mt-0">Fecha de
                                    nacimiento:{{ date('d/m/Y', strtotime($empleado->user->fecha_nac)) }}</p>
                                <p class="mt-0">Email: {{ $empleado->user->email }}</p>
                                <p class="mt-0">Teléfono: {{ $empleado->user->telefono }}</p>
                                <p class="mt-0">Dirección: {{ $empleado->user->direccion }}</p>
                                <p class="mt-0">Código Postal: {{ $empleado->user->cp }}</p>
                                <p class="mt-0">Población: {{ $empleado->user->poblacion }}</p>
                                <p class="mt-0">Salario: {{ $empleado->salario }} €</p>

                            </div>
                        </div>
                        <a href="{{ route('usuarios.empleado.edit', ['id' => $empleado->id]) }}"
                            class="btn btn-primary">Modificar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
