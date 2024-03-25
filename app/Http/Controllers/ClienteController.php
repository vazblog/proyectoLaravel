<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\User;
use App\Models\Tratamiento;
use App\Models\Empleado;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Perfil;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Controlador para gestionar las operaciones relacionadas con los clientes en el sistema.
 */
class ClienteController extends Controller
{

    /**
     * Muestra la lista de todos los clientes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            if (Auth::check()) {
                // Consultar los clientes desde la tabla correcta
                $clientes = Cliente::paginate(10);
                return view('usuarios.cliente.index', compact('clientes'));
            } else {
                return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
            }
        } catch (\Exception $e) {
            return redirect()->route('usuarios.cliente.index')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }





    /**
     * Muestra el formulario para crear un nuevo cliente.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  dd('Estoy en el método create de ClienteController');
        $tratamientos = Tratamiento::all();
        $empleados = Empleado::all();
        return view('usuarios.cliente.create', compact('tratamientos', 'empleados'));
    }

    /**
     * Almacena un nuevo cliente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        try {

            // Validar los datos del formulario
            $validator = Validator::make($request->all(), [
                'nombre' => 'required|string|max:255',
                'apellido_uno' => 'required|string|max:255',
                'apellido_dos' => 'required|string|max:255',
                'fecha_nac' => [
                    'required',
                    'date',
                    function ($attribute, $value, $fail) {
                        $fechaNacimiento = Carbon::createFromFormat('Y-m-d', $value);
                        $edadMinima = Carbon::now()->subYears(18);
                        if ($fechaNacimiento->greaterThanOrEqualTo($edadMinima)) {
                            $fail('Debes tener al menos 18 años.');
                        }
                    },
                ],
                'email' => 'required|string|email|max:255|unique:users',
                'telefono' => 'required|integer|digits:9',
                'direccion' => 'required|string|max:255',
                'cp' => 'required|integer|digits:5',
                'poblacion' => 'required|string|max:255',
                'DNI' => 'required|string|max:9|regex:/^\d{8}[a-zA-Z]$/',
                'password' => 'required|string|min:8|confirmed',
                'suscripcion' => 'required|in:S,N',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,tmp|max:2048',
            ]);


            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Crear un nuevo usuario
            $usuario = User::create([
                'name' => $request->nombre,
                'apellido_uno' => $request->apellido_uno,
                'apellido_dos' => $request->apellido_dos,
                'fecha_nac' => $request->fecha_nac,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'cp' => $request->cp,
                'poblacion' => $request->poblacion,
                'DNI' => $request->DNI,
                'password' => Hash::make($request->password),
                'perfil_id' => Perfil::where('tipo', 'cliente')->value('id')

            ]);


            // Guardar la imagen de perfil del usuario si se ha proporcionado
            if ($request->file('photo')) {
                $file = $request->file('photo');
                $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
                $file->move(public_path('upload/admin_images'), $filename);
                $usuario->photo = $filename;
                $usuario->save();
            }



            // Crear un nuevo cliente y asociarlo con el usuario recién creado
            $cliente = new Cliente();
            $cliente->user_id = $usuario->id;
            $cliente->suscripcion = $request->suscripcion;

            // Guardar el cliente
            $cliente->save();

            // Redirigir con un mensaje de éxito
            return redirect()->route('usuarios.cliente.index')->with('success', 'Cliente creado exitosamente.');
        } catch (\Exception $e) {
            // Manejar cualquier excepción y redirigir con un mensaje de error
            return redirect()->back()->withInput()->with('error', 'Error al crear el cliente: ' . $e->getMessage());
        }
    }


    /**
     * Muestra los detalles de un cliente específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('usuarios.cliente.show', compact('cliente'));
    }


    /**
     * Muestra el formulario para editar un cliente existente.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id); // Asumiendo que tienes un modelo Cliente

        // Verificar si el usuario tiene un perfil asociado
        if ($cliente->user->perfil_id && $cliente->user->perfil) {
            // Cargar la vista de edición correspondiente
            return view('usuarios.cliente.edit', compact('cliente'));
        } else {
            // Manejo de error: Usuario sin perfil asociado
            return redirect()->route('dashboard')->with('error', 'Error: El usuario no tiene un perfil asociado.');
        }
    }



    /**
     * Actualiza un cliente existente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // Validación de los datos del formulario
            $validator = Validator::make($request->all(), [
                'nombre' => 'required|string|max:255',
                'apellido_uno' => 'required|string|max:255',
                'apellido_dos' => 'nullable|string|max:255',
                'fecha_nac' => [
                    'required',
                    'date',
                    function ($attribute, $value, $fail) {
                        $fechaNacimiento = Carbon::createFromFormat('Y-m-d', $value);
                        $edadMinima = Carbon::now()->subYears(18);
                        if ($fechaNacimiento->greaterThanOrEqualTo($edadMinima)) {
                            $fail('Debes tener al menos 18 años.');
                        }
                    },
                ],
                'email' => 'required|email|max:255',
                'telefono' => 'required|integer|digits:9',
                'direccion' => 'required|string|max:255',
                'cp' => 'required|integer|digits:5',
                'poblacion' => 'required|string|max:255',
                'DNI' => 'required|string|max:9|regex:/^\d{8}[a-zA-Z]$/',
                'suscripcion' => 'required|in:S,N', // Validar el tipo de suscripción
                'photo' => 'image|mimes:jpeg,png,jpg,gif,tmp|max:2048',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Encuentra el cliente a actualizar
            $cliente = Cliente::findOrFail($id);

            // Actualiza los campos del cliente con los valores del formulario
            $cliente->user->name = $request->nombre;
            $cliente->user->apellido_uno = $request->apellido_uno;
            $cliente->user->apellido_dos = $request->apellido_dos;
            $cliente->user->fecha_nac = $request->fecha_nac;
            $cliente->user->email = $request->email;
            $cliente->user->telefono = $request->telefono;
            $cliente->user->direccion = $request->direccion;
            $cliente->user->cp = $request->cp;
            $cliente->user->poblacion = $request->poblacion;
            $cliente->user->DNI = $request->DNI;
            $cliente->suscripcion = $request->suscripcion; // Actualizar el campo de suscripción

            // Guarda la nueva foto de perfil del usuario si se ha proporcionado
            if ($request->file('photo')) {
                $file = $request->file('photo');
                $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
                $file->move(public_path('upload/admin_images'), $filename);
                $cliente->user->photo = $filename;
            }

            // Guarda los cambios en la base de datos
            $cliente->user->save();
            $cliente->save();

            // Redirige a la página de detalles del cliente actualizado
            return redirect()->route('usuarios.cliente.show', ['id' => $cliente->id])->with('success', 'Cliente actualizado exitosamente.');
        } catch (\Exception $e) {
            // Manejo de excepciones
            return redirect()->back()->withInput()->with('error', 'Error al actualizar el cliente: ' . $e->getMessage());
        }
    }


    /**
     * Elimina un cliente de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {

            // Buscar el cliente por su ID
            $cliente = Cliente::findOrFail($id);

            // Obtener el ID del usuario asociado al cliente
            $usuarioId = $cliente->user_id;

            // Obtener el objeto de usuario a partir de su ID
            $usuario = User::findOrFail($usuarioId);

            // Eliminar el cliente y el usuario
            $cliente->delete();
            $usuario->delete();

            // Redirigir a la página de inicio o a cualquier otra página deseada después de eliminar el cliente
            return redirect()->route('usuarios.cliente.index')->with('success', 'Cliente eliminado correctamente');
        } catch (\Exception $e) {
            // Manejo de excepciones
            return redirect()->route('usuarios.cliente.index')->with('error', 'Error al eliminar el cliente: ' . $e->getMessage());
        }
    }



    /**
     * Busca clientes por DNI.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function buscar(Request $request)
    {
        try {
            $search = $request->input('search');

            if ($search) {
                // Verificar si el valor introducido es un DNI válido (8 dígitos seguidos de una letra)
                if (!preg_match('/^[0-9]{8}[a-zA-Z]$/', $search)) {
                    return redirect()->route('usuarios.cliente.index')->with('error', 'El formato del DNI es incorrecto. Debe tener 8 dígitos seguidos de una letra.');
                }

                // Verificar si el cliente con el DNI proporcionado existe en la base de datos
                $cliente = Cliente::whereHas('user', function ($query) use ($search) {
                    $query->where('DNI', $search);
                })->first();

                if (!$cliente) {
                    return redirect()->route('usuarios.cliente.index')->with('error', 'El DNI proporcionado no se encuentra en la base de datos.');
                }

                // Buscar los clientes por su DNI
                $clientes = Cliente::whereHas('user', function ($query) use ($search) {
                    $query->where('DNI', $search);
                })->paginate(10);

                // Verificar si no se encontraron clientes con el DNI buscado
                $mensaje = $clientes->isEmpty() ? "No se encontraron clientes para el DNI '$search'." : null;
            } else {
                // Obtener todos los clientes si no hay término de búsqueda
                $clientes = Cliente::paginate(10);
                $mensaje = null; // No hay mensaje cuando no se realiza una búsqueda
            }

            return view('usuarios.cliente.index', compact('clientes', 'mensaje'));
        } catch (\Exception $e) {
            return redirect()->route('usuarios.cliente.index')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }
}
