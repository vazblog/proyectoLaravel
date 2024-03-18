@extends('layouts.app')

@section('title', 'Administrador')

@section('contenido')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6">
                <div class="card card-profile">
                    <div
                        class="card-header text-center mt-n4 mx-3 p-0 bg-transparent position-relative z-index-2 miFondo py-2 ">
                        <a class="d-block blur-shadow-image">
                            <img src="{{ !empty($user->photo) ? url('upload/admin_images/' . $user->photo) : url('upload/no_images.jpg') }}" alt="img-blur-shadow"
                                class="img-fluid avatar avatar-xxl rounded-circle ">
                        </a>
                    </div>
                    <div class="card-body text-center">
                        <h4 class="card-title">{{ $user->name }} {{ $user->apellido_uno }} {{ $user->apellido_dos }}</h4>
                        @if ($user->perfil->tipo == 'administrador')
                            <p>Administrador</p>
                        @endif
                        <div class="row justify-content-center text-start border-top pt-2">
                            <div class="col-lg-12 col-12">
                                <p class="mt-0">DNI: {{ $user->DNI }}</p>
                                <p class="mt-0">Fecha de Nacimiento: {{ date('d/m/Y', strtotime($user->fecha_nac)) }}</p>
                                <p class="mt-0">Email: {{ $user->email }}</p>
                                <p class="mt-0">Teléfono: {{ $user->telefono }}</p>
                                <p class="mt-0">Dirección: {{ $user->direccion }}</p>
                                <p class="mt-0">Código Postal: {{ $user->cp }}</p>
                                <p class="mt-0">Población: {{ $user->poblacion }}</p>
                            </div>
                        </div>
                        <a href="{{ route('usuarios.administrador.edit', ['id' => $user->id]) }}"
                            class="btn btn-primary">Modificar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

