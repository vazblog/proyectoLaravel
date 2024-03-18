@extends('layouts.app')
@section('title', 'Tratamientos')
@section('contenido')
    <section class="py-5 bg-gray-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-7 col-md-8 mx-auto">

                    <div class="card">
                        <div class="card-header">
                            <h4 class="font-weight-bolder mt-1">Crear Nuevo Tratamiento</h4>
                            <p class="mb-1 text-sm">Por favor, ingresa la información solicitada para crear un nuevo
                                tratamiento.</p>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('tratamientos.store') }}">
                                @csrf

                                <div class="input-group input-group-static mb-4">
                                    <label for="nombre">{{ __('Nombre') }}</label>
                                    <input id="nombre" type="text"
                                        class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                        value="{{ old('nombre') }}" required
                                        placeholder="Ingrese el nombre del tratamiento">
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label for="descripcion">{{ __('Descripción') }}</label>
                                    <textarea id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" required
                                        placeholder="Ingrese la descripción del tratamiento">{{ old('descripcion') }}</textarea>
                                    @error('descripcion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label for="duracion">{{ __('Duración') }}</label>
                                    <input id="duracion" type="number"
                                        class="form-control @error('duracion') is-invalid @enderror" name="duracion"
                                        value="{{ old('duracion') }}" required
                                        placeholder="Ingrese la duración del tratamiento en minutos">
                                    @error('duracion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label for="precio">{{ __('Precio') }}</label>
                                    <input id="precio" type="number"
                                        class="form-control @error('precio') is-invalid @enderror" name="precio"
                                        value="{{ old('precio') }}" required
                                        placeholder="Ingrese el precio del tratamiento" step="any">
                                    @error('precio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" id="registroButton">
                                        {{ __('Crear Tratamiento') }}
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
