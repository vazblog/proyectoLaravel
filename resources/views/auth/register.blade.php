@extends('layouts.app')
@section('contenido')
    <section class="py-5 bg-gray-100">
        <div class="container">
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


            <div class="row">
                <div class="col-xl-6 col-lg-7 col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="font-weight-bolder mt-1">Registro de Cliente</h4>
                            <p class="mb-1 text-sm">Por favor, ingresa la información solicitada para registrarte como
                                cliente.</p>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group input-group-static mb-4">
                                    <label for="DNI">{{ __('DNI') }}</label>
                                    <input id="DNI" type="text"
                                        class="form-control @error('DNI') is-invalid @enderror" name="DNI"
                                        value="{{ old('DNI') }}" required autofocus placeholder="Ingrese su DNI">
                                    @error('DNI')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group input-group-static mb-4">
                                    <label for="name">{{ __('Nombre') }}</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required placeholder="Ingrese su nombre">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group input-group-static mb-4">
                                    <label for="apellido_uno">{{ __('Primer Apellido') }}</label>
                                    <input id="apellido_uno" type="text"
                                        class="form-control @error('apellido_uno') is-invalid @enderror" name="apellido_uno"
                                        value="{{ old('apellido_uno') }}" required
                                        placeholder="Ingrese su primer apellido">
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
                                        placeholder="Ingrese su segundo apellido">
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
                                    <input id="telefono" type="text"
                                        class="form-control @error('telefono') is-invalid @enderror" name="telefono"
                                        value="{{ old('telefono') }}" required
                                        placeholder="Ingrese su número de teléfono">
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
                                        value="{{ old('direccion') }}" required placeholder="Ingrese su dirección">
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
                                        value="{{ old('cp') }}" required placeholder="Ingrese su código postal">
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
                                        value="{{ old('poblacion') }}" required placeholder="Ingrese su población">
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
                                        value="{{ old('email') }}" required placeholder="Ingrese su correo electrónico">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group input-group-static mb-4">
                                    <label for="password">{{ __('Contraseña') }}</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required placeholder="Ingrese su contraseña">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group input-group-static mb-4">
                                    <label for="password-confirm">{{ __('Confirmar Contraseña') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required placeholder="Confirme su contraseña">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="suscripcion">{{ __('Suscripción') }}</label>
                                    <select id="suscripcion"
                                        class="form-select @error('suscripcion') is-invalid @enderror"
                                        name="suscripcion" required>
                                        <option value="S">Sí</option>
                                        <option value="N">No</option>
                                    </select>
                                    @error('suscripcion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" id="registroButton">
                                        {{ __('Registrar') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center pt-0 px-lg-2 px-1">
                            <p class="mb-4 text-sm mx-auto">
                                ¿Ya tienes una cuenta? <a href="{{ route('login') }}"
                                    class="text-success text-gradient font-weight-bold">Inicia sesión aquí</a>
                            </p>
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
