@extends('layouts.app')
@section('title', 'Panel')
@section('contenido')
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-7 mx-auto text-center">
                    <h3>Hola {{ auth()->user()->name }}</h3>
                    <!-- Mostrar el tipo de usuario -->
                    @auth
                        @if (Auth::user()->perfil_id && Auth::user()->perfil)
                            @php
                                $perfil = Auth::user()->perfil;
                                $tipoPerfil = $perfil->tipo;
                            @endphp
                            <p>Aquí te mostramos un resumen de nuestro sitio.</p>
                        @endif
                    @endauth

                </div>
            </div>

            @auth
                @if (Auth::user()->perfil_id && Auth::user()->perfil)
                    @php
                        $perfil = Auth::user()->perfil;
                        $tipoPerfil = $perfil->tipo;
                    @endphp
                    @if ($tipoPerfil === 'cliente')
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-md-6 m-auto">
                                    <h4>Recibe nuestras noticias</h4>
                                    <p class="mb-4">
                                        Descubre lo último en belleza y bienestar con nuestra newsletter exclusiva. ¡Suscríbete
                                        ahora y recibe contenido especial directamente en tu correo!
                                    </p>
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="input-group input-group-static">
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email') }}" required
                                                    placeholder="Ingrese su correo electrónico">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4 ps-0">
                                            <button type="button"
                                                class="btn bg-gradient-primary mb-0 h-100 position-relative z-index-2">Suscríbete</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 ms-auto">
                                    <div class="position-relative">
                                        <img class="max-width-50 w-100 position-relative z-index-2"
                                            src="{{ asset('images/beautyzencorto.svg') }}" alt="logo">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row justify-content-center mt-4">
                            <div class="col-lg-6 text-center">
                                <img src="{{ asset('images/beautyzencorto.svg') }}" class="img-fluid mt-4 mb-3"
                                    alt="beautyzen icono">
                            </div>

                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title text-center">Resumen de BeautyZen</h5>
                                    </div>
                                    <div class="table-responsive mx-2 my-2">
                                        <table class="table align-items-center mb-0">
                                            <thead>

                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h6 class="mb-0">Clientes</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-0">{{ App\Models\Cliente::count() }}</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6 class="mb-0">Tratamientos</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-0">{{ App\Models\Tratamiento::count() }}</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6 class="mb-0">Empleados</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-0">{{ App\Models\Empleado::count() }}</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6 class="mb-0">Productos</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-0">{{ App\Models\Producto::count() }}</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6 class="mb-0">Citas</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-0">{{ App\Models\Cita::count() }}</h6>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            @endauth

        </div>
    </section>
@endsection
