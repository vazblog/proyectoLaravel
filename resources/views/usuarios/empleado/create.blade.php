@extends('layouts.app')
@section('title', 'Empleado')
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
                            <h4 class="font-weight-bolder mt-1">Crear Nuevo Empleado</h4>
                            <p class="mb-1 text-sm">Por favor, ingresa la información solicitada para crear un nuevo
                                empleado/a.
                            </p>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('usuarios.empleado.store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="input-group input-group-static mb-4">
                                    <label for="nombre">{{ __('Nombre') }}</label>
                                    <input id="nombre" type="text"
                                        class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                        value="{{ old('nombre') }}" required placeholder="Ingrese el nombre del cliente">
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label for="apellido_uno">{{ __('Primer Apellido') }}</label>
                                    <input id="apellido_uno" type="text"
                                        class="form-control @error('apellido_uno') is-invalid @enderror" name="apellido_uno"
                                        value="{{ old('apellido_uno') }}" required placeholder="Ingrese el primer apellido">
                                    @error('apellido_uno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label for="apellido_dos">{{ __('Segundo Apellido') }}</label>
                                    <input id="apellido_dos" type="text"
                                        class="form-control @error('apellido_dos') is-invalid @enderror" name="apellido_dos"
                                        value="{{ old('apellido_dos') }}" required
                                        placeholder="Ingrese el segundo apellido">
                                    @error('apellido_dos')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="input-group input-group-static mb-4">
                                    <label for="photo">{{ __('Foto de perfil') }}</label>

                                    <input id="image" type="file"
                                        class="form-control @error('photo') is-invalid @enderror" name="photo"
                                        value="{{ old('photo') }}" placeholder="Seleccione una imagen">


                                    @error('photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group mb-4 d-flex align-items-center">
                                    <label for="photo">{{ __('Foto de perfil') }}</label>
                                    <div class="avatar-container ms-2">
                                        <img id="showImage"
                                            src="{{ !empty($user->photo) ? url('upload/admin_images/' . $user->photo) : url('upload/no_images.jpg') }}"
                                            alt="img-blur-shadow" class="img-fluid avatar avatar-xl rounded-circle">
                                    </div>
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label for="DNI">{{ __('DNI') }}</label>
                                    <input id="DNI" type="text"
                                        class="form-control @error('DNI') is-invalid @enderror" name="DNI"
                                        value="{{ old('DNI') }}" required placeholder="Ingrese el DNI del cliente">
                                    @error('DNI')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label for="fecha_nac">{{ __('Fecha de Nacimiento') }}</label>
                                    <input id="fecha_nac" type="date"
                                        class="form-control @error('fecha_nac') is-invalid @enderror" name="fecha_nac"
                                        value="{{ old('fecha_nac') }}" required>
                                    @error('fecha_nac')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label for="telefono">{{ __('Teléfono') }}</label>
                                    <input id="telefono" type="tel"
                                        class="form-control @error('telefono') is-invalid @enderror" name="telefono"
                                        value="{{ old('telefono') }}" required placeholder="Ingrese el teléfono">
                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label for="direccion">{{ __('Dirección') }}</label>
                                    <input id="direccion" type="text"
                                        class="form-control @error('direccion') is-invalid @enderror" name="direccion"
                                        value="{{ old('direccion') }}" required placeholder="Ingrese la dirección">
                                    @error('direccion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label for="cp">{{ __('Código Postal') }}</label>
                                    <input id="cp" type="text"
                                        class="form-control @error('cp') is-invalid @enderror" name="cp"
                                        value="{{ old('cp') }}" required placeholder="Ingrese el código postal">
                                    @error('cp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label for="poblacion">{{ __('Población') }}</label>
                                    <input id="poblacion" type="text"
                                        class="form-control @error('poblacion') is-invalid @enderror" name="poblacion"
                                        value="{{ old('poblacion') }}" required placeholder="Ingrese la población">
                                    @error('poblacion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label for="email">{{ __('Correo Electrónico') }}</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required placeholder="Ingrese el correo electrónico">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <!-- Campo de rol de empleado -->
                                <div class="form-group">
                                    <label for="rol_empleado">Tipo de empleado</label>
                                    <select class="form-control @error('rol_empleado') is-invalid @enderror"
                                    id="rol_empleado" name="rol_empleado">
                                        <option value="">Selecciona un rol de empleado</option>
                                        <option value="medico">Médico</option>
                                        <option value="estetico">Estético</option>
                                        <option value="auxiliar">Auxiliar</option>
                                        <option value="recepcionista">Recepcionista</option>
                                    </select>
                                </div>






                                <div class="input-group input-group-static mb-4">
                                    <label>{{ __('Salario') }}</label><br>
                                    <input id="salario" type="text"
                                        class="form-control @error('salario') is-invalid @enderror" name="salario"
                                        value="{{ old('salario') }}" required placeholder="Ingrese el salario">
                                    @error('salario')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label for="password">{{ __('Contraseña') }}</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" placeholder="Ingrese la contraseña">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label for="password-confirm">{{ __('Confirmar Contraseña') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="Confirme la contraseña">
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {

                var reader = new FileReader();

                reader.onload = function(e) {

                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
