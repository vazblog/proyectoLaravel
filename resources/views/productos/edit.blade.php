@extends('layouts.app')
@section('title', 'Productos')
@section('contenido')
    <section class="py-5 bg-gray-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-7 col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="font-weight-bolder mt-1">Modificar Producto</h4>
                            <p class="mb-1 text-sm">Por favor, modifica la información del producto.</p>
                        </div>
                        <div class="card-body">
                            
                            <form method="POST" action="{{ route('productos.update', $producto->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="input-group input-group-static mb-4">
                                    <label for="nombre">{{ __('Nombre') }}</label>
                                    <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ $producto->nombre }}" required placeholder="Ingrese el nombre del producto">
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label for="descripcion">{{ __('Descripción') }}</label>
                                    <textarea id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" required placeholder="Ingrese la descripción del producto">{{ $producto->descripcion }}</textarea>
                                    @error('descripcion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label for="precio">{{ __('Precio') }}</label>
                                    <input id="precio" type="number" class="form-control @error('precio') is-invalid @enderror" name="precio" value="{{ $producto->precio }}" required placeholder="Ingrese el precio del producto" step="any">
                                    @error('precio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label for="stock">{{ __('Stock') }}</label>
                                    <input id="stock" type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ $producto->stock }}" required placeholder="Ingrese la cantidad en stock del producto" step="any">
                                    @error('stock')
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
