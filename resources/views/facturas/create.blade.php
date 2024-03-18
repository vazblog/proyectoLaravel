@extends('layouts.app')
@section('title', 'Facturas')
@section('contenido')
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

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Crear Factura') }}</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('facturas.crearFactura') }}">
                            @csrf

                            <div class="col-xl-4 col-lg-5 col-md-7 mx-start">
                                <div class="input-group input-group-static mb-4">
                                    <label for="dni_cliente" class="col-form-label">
                                        <h5>DNI del Cliente</h5>
                                    </label>
                                    <input type="text" name="dni_cliente" id="dni_cliente" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <button type="button" class="btn btn-primary" onclick="buscarCitas()">Buscar</button>
                            </div>

                            <div id="citasContainer" style="display: none;">
                                <label for="cita_id" class="col-form-label">
                                    <h5>Selecciona una cita</h5>
                                </label>
                                <select name="cita_id" id="cita_id" class="form-select" required>
                                    <option value="">Selecciona una cita</option>
                                </select>
                            </div>
                            <label for="productos" class="col-form-label">
                                <h5>Productos disponibles</h5>
                            </label>
                            <div id="productosContainer" style="overflow-y: scroll; height: 200px;">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productos as $producto)
                                            <tr>
                                                <td>{{ $producto->nombre }}</td>
                                                <td>{{ $producto->precio }}</td>
                                                <td>
                                                    <input type="number" name="productos[{{ $producto->id }}][cantidad]"
                                                        class="form-control" min="0" max="{{ $producto->stock }}"
                                                        value="0">
                                                    <input type="hidden" name="productos[{{ $producto->id }}][producto_id]"
                                                        value="{{ $producto->id }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-group mt-5">
                                <button type="submit" class="btn btn-success">Generar Factura</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function buscarCitas() {
            var dniCliente = document.getElementById('dni_cliente').value;
            // Expresión regular para validar el formato del DNI (8 dígitos seguidos de una letra)
            var dniRegex = /^[0-9]{8}[a-zA-Z]$/;
            if (!dniRegex.test(dniCliente)) {
                // El DNI no cumple con el formato esperado
                var errorMessage = `
            <div class="position-fixed top-50 start-50 translate-middle" style="z-index: 1050;">
                <div class="toast fade show p-2 mx-auto mt-7" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-body text-center">
                        El formato del DNI es incorrecto. Debe tener 8 dígitos seguidos de una letra.
                        <hr class="horizontal dark">
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn bg-gradient-danger btn-sm me-2 mb-0"
                                data-bs-dismiss="toast">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
                // Agregar el mensaje de error al cuerpo del documento
                document.body.innerHTML += errorMessage;
                return;
            }

            // Realizar la solicitud AJAX para obtener las citas del cliente
            // Reemplaza la URL con la ruta de tu controlador que maneja la solicitud AJAX
            // En el controlador, busca las citas del cliente por el DNI proporcionado
            // y devuelve las citas como JSON
            var url = "{{ route('obtenerCitasPorDni', ':dni') }}".replace(':dni', dniCliente);
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('El DNI proporcionado no existe en la base de datos.');
                    }
                    return response.json();
                })
                .then(data => {
                    // Limpiar select
                    var selectCitas = document.getElementById('cita_id');
                    selectCitas.innerHTML = '<option value="">Selecciona una cita</option>';
                    // Agregar las citas al select
                    data.forEach(cita => {
                        var option = document.createElement('option');
                        option.value = cita.id;
                        option.text = cita.fecha_hora;
                        selectCitas.appendChild(option);
                    });
                    // Mostrar el contenedor de citas
                    document.getElementById('citasContainer').style.display = 'block';
                })
                .catch(error => {
                    console.error('Error:', error.message);
                    // Construir el mensaje de error en un div
                    var errorMessage = `
                <div class="position-fixed top-50 start-50 translate-middle" style="z-index: 1050;">
                    <div class="toast fade show p-2 mx-auto mt-7" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-body text-center">
                            ${error.message}
                            <hr class="horizontal dark">
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn bg-gradient-danger btn-sm me-2 mb-0"
                                    data-bs-dismiss="toast">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
                    // Agregar el mensaje de error al cuerpo del documento
                    document.body.innerHTML += errorMessage;
                });
        }
    </script>
@endsection
