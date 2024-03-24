<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TratamientoController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/*
* Rutas públicas
*/
Route::get('/', function () {
    return view('inicio/inicio');
})->name('inicio');

Route::get('/quienes', function () {
    return view('quienes/quienes');
})->name('quienes');

Route::get('/productos-estaticos', function () {
    return view('productos/productos');
})->name('productos-estaticos');

Route::get('/contacto', function () {
    return view('contacto/contacto');
})->name('contacto');


Route::get('/cita', function () {
    return view('citas/cita');
})->name('cita');


Route::get('/auth/login', function () {
    return view('auth/login');
})->name('login');

Route::get('/auth/register', function () {
    return view('auth/register');
})->name('register');


Route::get('/servicios/tratamientos', function () {
    return view('servicios.tratamientos');
})->name('servicios.tratamientos');

Route::get('/servicios/depilacion', function () {
    return view('servicios.depilacion');
})->name('servicios.depilacion');

Route::get('/servicios/esteticos', function () {
    return view('servicios.esteticos');
})->name('servicios.esteticos');



// Rutas de autenticación
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('checkUserRole');
Route::get('/auth/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/auth/login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/auth/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/auth/register', [RegisterController::class, 'register']);





// Rutas para usuarios autenticados y con roles verificados
Route::middleware(['auth', 'checkUserRole'])->group(function () {
    // Productos
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/crear', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
    Route::get('/productos/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
    Route::get('/productos/buscar', [ProductoController::class, 'buscar'])->name('productos.buscar');
    
    // Tratamientos
    Route::get('/tratamientos', [TratamientoController::class, 'index'])->name('tratamientos.index');
    Route::get('/tratamientos/crear', [TratamientoController::class, 'create'])->name('tratamientos.create');
    Route::post('/tratamientos', [TratamientoController::class, 'store'])->name('tratamientos.store');
    Route::delete('/tratamientos/{id}', [TratamientoController::class, 'destroy'])->name('tratamientos.destroy');
    Route::get('/tratamientos/{id}/edit', [TratamientoController::class, 'edit'])->name('tratamientos.edit');
    Route::put('/tratamientos/{id}', [TratamientoController::class, 'update'])->name('tratamientos.update');
    Route::get('/tratamientos/buscar', [TratamientoController::class, 'buscar'])->name('tratamientos.buscar');
    
    // Citas
    Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');
    Route::get('/citas/crear', [CitaController::class, 'create'])->name('citas.create');
    Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');
    Route::delete('/citas/{id}', [CitaController::class, 'destroy'])->name('citas.destroy');
    Route::get('/citas/{id}/edit', [CitaController::class, 'edit'])->name('citas.edit');
    Route::put('/citas/{id}', [CitaController::class, 'update'])->name('citas.update');
    Route::get('/citas/buscar', [CitaController::class, 'buscar'])->name('citas.buscar');
    Route::get('/citas/cliente/{id}', [CitaController::class, 'show'])->name('citas.show');
    Route::get('/citas/{id}/imprimir', [CitaController::class, 'citaImprimir'])->name('citas.imprimir');

    // Facturas
    Route::get('/facturas', [FacturaController::class, 'index'])->name('facturas.index');
    Route::get('/facturas/crear', [FacturaController::class, 'create'])->name('facturas.create');
    Route::post('/facturas', [FacturaController::class, 'store'])->name('facturas.store');
    Route::delete('/facturas/{id}', [FacturaController::class, 'destroy'])->name('facturas.destroy');
    Route::get('/facturas/{id}/edit', [FacturaController::class, 'edit'])->name('facturas.edit');
    Route::put('/facturas/{id}', [FacturaController::class, 'update'])->name('facturas.update');
    Route::get('/facturas/buscar', [FacturaController::class, 'buscar'])->name('facturas.buscar');
    Route::get('/facturas/{id}', [FacturaController::class, 'show'])->name('facturas.show');
    

    // Usuario cliente
    Route::get('/usuarios', [ClienteController::class, 'index'])->name('usuarios.cliente.index');
    Route::delete('/usuarios/cliente/{id}', [ClienteController::class, 'destroy'])->name('usuarios.cliente.destroy');
    Route::get('/usuarios/cliente/{id}', [ClienteController::class, 'show'])->name('usuarios.cliente.show');
    Route::get('/usuarios/cliente/{id}/edit', [ClienteController::class, 'edit'])->name('usuarios.cliente.edit');
    Route::get('/usuarios/cliente/', [ClienteController::class, 'create'])->name('usuarios.cliente.create');
    Route::post('/usuarios/clientes', [ClienteController::class, 'store'])->name('usuarios.clientes.store');
    Route::put('usuarios/clientes/{id}', [ClienteController::class, 'update'])->name('usuarios.cliente.update');
    Route::get('/usuarios/buscar', [ClienteController::class, 'buscar'])->name('usuarios.cliente.buscar');

    // Usuario empleado
    // Rutas para la gestión de empleados
    Route::prefix('usuarios/empleado')->group(function () {
        Route::get('/', [EmpleadoController::class, 'index'])->name('usuarios.empleado.index');
        Route::get('/crear', [EmpleadoController::class, 'create'])->name('usuarios.empleado.create');
        Route::get('/buscar', [EmpleadoController::class, 'buscar'])->name('usuarios.empleado.buscar');
        Route::post('/store', [EmpleadoController::class, 'store'])->name('usuarios.empleado.store');
        Route::get('/{id}', [EmpleadoController::class, 'show'])->name('usuarios.empleado.show');
        Route::get('/{id}/edit', [EmpleadoController::class, 'edit'])->name('usuarios.empleado.edit');
        Route::put('/{id}', [EmpleadoController::class, 'update'])->name('usuarios.empleado.update');
        Route::delete('/{id}', [EmpleadoController::class, 'destroy'])->name('usuarios.empleado.destroy');
    });

    // Rutas para la gestión de administrador
    Route::prefix('usuarios/admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('usuarios.administrador.index');
        Route::get('/crear', [AdminController::class, 'create'])->name('usuarios.administrador.create');
        Route::get('/buscar', [AdminController::class, 'buscar'])->name('usuarios.administrador.buscar');
        Route::post('/store', [AdminController::class, 'store'])->name('usuarios.administrador.store');
        Route::get('/{id}', [AdminController::class, 'show'])->name('usuarios.administrador.show');
        Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('usuarios.administrador.edit');
        Route::put('/{id}', [AdminController::class, 'update'])->name('usuarios.administrador.update');
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('usuarios.administrador.destroy');
    });

    // Ruta para editar usuario
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');

    // Otras rutas relacionadas con usuarios y citas
    Route::get('/clientes/{cliente}/citas', [FacturaController::class, 'citasPorCliente']);
    Route::get('/citasPorCliente/{clienteId}', 'FacturaController@citasPorCliente');
    Route::get('/obtener-citas/{dni}', [FacturaController::class, 'obtenerCitasPorDni'])->name('obtenerCitasPorDni');
    Route::post('/facturas/crear', [FacturaController::class, 'crearFactura'])->name('facturas.crearFactura');
    Route::get('/clientes/{clienteId}/citas', [CitaController::class, 'citasCliente']);

    // Dashboard    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});

// Ruta para mostrar detalles de una cita
Route::get('/cita/{id}', [CitaController::class, 'show'])->name('cita.show');








/*
// Ruta para usuarios autenticados
Route::middleware(['auth'])->group(function () {
    // Productos
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/crear', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
    Route::get('/productos/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
    Route::get('/productos/buscar', [ProductoController::class, 'buscar'])->name('productos.buscar');
    //Tratamientos
    Route::get('/tratamientos', [TratamientoController::class, 'index'])->name('tratamientos.index');
    Route::get('/tratamientos/crear', [TratamientoController::class, 'create'])->name('tratamientos.create');
    Route::post('/tratamientos', [TratamientoController::class, 'store'])->name('tratamientos.store');
    Route::delete('/tratamientos/{id}', [TratamientoController::class, 'destroy'])->name('tratamientos.destroy');
    Route::get('/tratamientos/{id}/edit', [TratamientoController::class, 'edit'])->name('tratamientos.edit');
    Route::put('/tratamientos/{id}', [TratamientoController::class, 'update'])->name('tratamientos.update');
    Route::get('/tratamientos/buscar', [TratamientoController::class, 'buscar'])->name('tratamientos.buscar');
    // Citas
    Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');
    Route::get('/citas/crear', [CitaController::class, 'create'])->name('citas.create');
    Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');
    Route::delete('/citas/{id}', [CitaController::class, 'destroy'])->name('citas.destroy');
    Route::get('/citas/{id}/edit', [CitaController::class, 'edit'])->name('citas.edit');
    Route::put('/citas/{id}', [CitaController::class, 'update'])->name('citas.update');
    Route::get('/citas/buscar', [CitaController::class, 'buscar'])->name('citas.buscar');
    Route::get('/citas/cliente/{id}', [CitaController::class, 'show'])->name('citas.show');
    Route::get('/citas/{id}/imprimir', [CitaController::class, 'citaImprimir'])->name('citas.imprimir');

    // Facturas
    Route::get('/facturas', [FacturaController::class, 'index'])->name('facturas.index');
    Route::get('/facturas/crear', [FacturaController::class, 'create'])->name('facturas.create');
    Route::post('/facturas', [FacturaController::class, 'store'])->name('facturas.store');
    Route::delete('/facturas/{id}', [FacturaController::class, 'destroy'])->name('facturas.destroy');
    Route::get('/facturas/{id}/edit', [FacturaController::class, 'edit'])->name('facturas.edit');
    Route::put('/facturas/{id}', [FacturaController::class, 'update'])->name('facturas.update');
    Route::get('/facturas/buscar', [FacturaController::class, 'buscar'])->name('facturas.buscar');
    Route::get('/facturas/{id}', [FacturaController::class, 'show'])->name('facturas.show');
    // Usuario cliente
    Route::get('/usuarios', [ClienteController::class, 'index'])->name('usuarios.cliente.index');
    Route::delete('/usuarios/cliente/{id}', [ClienteController::class, 'destroy'])->name('usuarios.cliente.destroy');
    Route::get('/usuarios/cliente/{id}', [ClienteController::class, 'show'])->name('usuarios.cliente.show');
    Route::get('/usuarios/cliente/{id}/edit', [ClienteController::class, 'edit'])->name('usuarios.cliente.edit');
    Route::get('/usuarios/cliente/', [ClienteController::class, 'create'])->name('usuarios.cliente.create');
    Route::post('/usuarios/clientes', [ClienteController::class, 'store'])->name('usuarios.clientes.store');
    Route::put('usuarios/clientes/{id}', [ClienteController::class, 'update'])->name('usuarios.cliente.update');
    Route::get('/usuarios/buscar', [ClienteController::class, 'buscar'])->name('usuarios.cliente.buscar');

    // Usuario empleado
    // Rutas para la gestión de empleados
    Route::prefix('usuarios/empleado')->group(function () {
        Route::get('/', [EmpleadoController::class, 'index'])->name('usuarios.empleado.index');
        Route::get('/crear', [EmpleadoController::class, 'create'])->name('usuarios.empleado.create');
        Route::get('/buscar', [EmpleadoController::class, 'buscar'])->name('usuarios.empleado.buscar');
        Route::post('/store', [EmpleadoController::class, 'store'])->name('usuarios.empleado.store');
        Route::get('/{id}', [EmpleadoController::class, 'show'])->name('usuarios.empleado.show');
        Route::get('/{id}/edit', [EmpleadoController::class, 'edit'])->name('usuarios.empleado.edit');
        Route::put('/{id}', [EmpleadoController::class, 'update'])->name('usuarios.empleado.update');
        Route::delete('/{id}', [EmpleadoController::class, 'destroy'])->name('usuarios.empleado.destroy');
    });


    // Rutas para la gestión de admininistrador
    Route::prefix('usuarios/admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('usuarios.administrador.index');
        Route::get('/crear', [AdminController::class, 'create'])->name('usuarios.administrador.create');
        Route::get('/buscar', [AdminController::class, 'buscar'])->name('usuarios.administrador.buscar');
        Route::post('/store', [AdminController::class, 'store'])->name('usuarios.administrador.store');
        Route::get('/{id}', [AdminController::class, 'show'])->name('usuarios.administrador.show');
        Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('usuarios.administrador.edit');
        Route::put('/{id}', [AdminController::class, 'update'])->name('usuarios.administrador.update');
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('usuarios.administrador.destroy');
    });



// En tu archivo de rutas
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');


    Route::get('/clientes/{cliente}/citas', [FacturaController::class, 'citasPorCliente']);
    Route::get('/citasPorCliente/{clienteId}', 'FacturaController@citasPorCliente');
    Route::get('/obtener-citas/{dni}', [FacturaController::class, 'obtenerCitasPorDni'])->name('obtenerCitasPorDni');
    Route::post('/facturas/crear', [FacturaController::class, 'crearFactura'])->name('facturas.crearFactura');
    Route::get('/clientes/{clienteId}/citas', [CitaController::class, 'citasCliente']);
    //Dashboard    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});


Route::get('/cita/{id}', [CitaController::class, 'show'])->name('cita.show');

*/






