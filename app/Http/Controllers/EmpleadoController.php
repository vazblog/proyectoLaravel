<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\User;
use App\Models\Perfil;
use App\Models\Cita;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;


/**
 * Controlador para manejar las operaciones relacionadas con los empleados.
 */
class EmpleadoController extends Controller
{

    /**
     * Muestra una lista paginada de empleados.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        try {
            if (Auth::check()) {
                // Consultar los empleados desde la tabla correcta
                $empleados = Empleado::paginate(10);
                return view('usuarios.empleado.index', compact('empleados'));
            } else {
                return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
            }
        } catch (\Exception $e) {
            return redirect()->route('usuarios.empleado.index')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }


    /**
     * Muestra el formulario para crear un nuevo empleado.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('usuarios.empleado.create');
    }


    /**
     * Muestra el formulario de edición de un empleado específico.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('usuarios.empleado.edit', compact('empleado'));
    }


    /**
     * Almacena un nuevo empleado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validación de los datos del formulario
            $validator = Validator::make($request->all(), [
                // Validación de los campos de usuario
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
                'DNI' => 'required|string|max:9|regex:/^\d{8}[a-zA-Z]$/',
                'poblacion' => 'required|string|max:255',
                'password' => 'required|string|min:8|confirmed',
                'salario' => 'required|string|max:255',
                'rol_empleado' => 'required|string|in:medico,estetico,auxiliar,recepcionista', // Validar el rol del empleado
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
                'perfil_id' => Perfil::where('tipo', 'empleado')->value('id')
            ]);


            // Guardar la imagen de perfil del usuario si se ha proporcionado
            if ($request->file('photo')) {
                $file = $request->file('photo');
                $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
                $file->move(public_path('upload/admin_images'), $filename);
                $usuario->photo = $filename;
                $usuario->save();
            }



            // Crear un nuevo empleado y asociarlo con el usuario recién creado
            $empleado = new Empleado();
            $empleado->user_id = $usuario->id;
            $empleado->salario = $request->salario;
            $empleado->rol_empleado = $request->rol_empleado; // Asignar el rol del empleado

            // Guardar el empleado
            $empleado->save();

            // Redirigir con un mensaje de éxito
            return redirect()->route('usuarios.empleado.index')->with('success', 'Empleado creado exitosamente.');
        } catch (\Exception $e) {
            // Manejar cualquier excepción y redirigir con un mensaje de error
            return redirect()->back()->withInput()->with('error', 'Error al crear el empleado: ' . $e->getMessage());
        }
    }


    /**
     * Actualiza un empleado existente en la base de datos.
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
                // Validación de los campos de usuario
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
                'DNI' => 'required|string|max:9|regex:/^\d{8}[a-zA-Z]$/',
                'poblacion' => 'required|string|max:255',
                'rol_empleado' => 'required|string|in:medico,estetico,auxiliar,recepcionista', // Validar el rol del empleado
                'salario' => 'required|string|max:255',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,tmp|max:2048',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Encuentra el empleado a actualizar
            $empleado = Empleado::findOrFail($id);

            // Actualiza los campos del usuario asociado con el empleado
            $empleado->user->update([
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
            ]);

            // Guarda la nueva foto de perfil del usuario si se ha proporcionado
            if ($request->file('photo')) {
                $file = $request->file('photo');
                $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
                $file->move(public_path('upload/admin_images'), $filename);
                $empleado->user->photo = $filename;
                $empleado->user->save(); // Guarda los cambios en la base de datos
            }

            // Actualiza los campos específicos del empleado
            $empleado->update([
                'salario' => $request->salario,
                'rol_empleado' => $request->rol_empleado,
            ]);

            // Redirige a la página de detalles del empleado actualizado
            return redirect()->route('usuarios.empleado.index')->with('success', 'Empleado actualizado exitosamente.');
        } catch (\Exception $e) {
            // Manejo de excepciones
            return redirect()->back()->withInput()->with('error', 'Error al actualizar el empleado: ' . $e->getMessage());
        }
    }




    /**
     * Muestra los detalles de un empleado específico.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('usuarios.empleado.show', compact('empleado'));
    }



    /**
     * Elimina un empleado de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        try {
            // Buscar el empleado por su ID
            $empleado = Empleado::findOrFail($id);

            // Obtener el ID del usuario asociado al empleado
            $usuarioId = $empleado->user_id;

            // Obtener el objeto de usuario a partir de su ID
            $usuario = User::findOrFail($usuarioId);

            // Eliminar el empleado y el usuario
            $empleado->delete();
            $usuario->delete();

            // Redirigir a la página de inicio o a cualquier otra página deseada después de eliminar el empleado
            return redirect()->route('usuarios.empleado.index')->with('success', 'Empleado eliminado correctamente');
        } catch (\Exception $e) {
            // Manejo de excepciones
            return redirect()->route('usuarios.empleado.index')->with('error', 'Error al eliminar el empleado: ' . $e->getMessage());
        }
    }
    




    /**
     * Busca empleados por DNI y muestra los resultados paginados.
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
                    return redirect()->route('usuarios.empleado.index')->with('error', 'El formato del DNI es incorrecto. Debe tener 8 dígitos seguidos de una letra.');
                }

                // Verificar si el empleado con el DNI proporcionado existe en la base de datos
                $empleado = Empleado::whereHas('user', function ($query) use ($search) {
                    $query->where('DNI', $search);
                })->first();

                if (!$empleado) {
                    return redirect()->route('usuarios.empleado.index')->with('error', 'El DNI proporcionado no se encuentra en la base de datos.');
                }

                // Buscar los empleados por su DNI
                $empleados = Empleado::whereHas('user', function ($query) use ($search) {
                    $query->where('DNI', $search);
                })->paginate(10);

                // Verificar si no se encontraron empleados con el DNI buscado
                $mensaje = $empleados->isEmpty() ? "No se encontraron empleados para el DNI '$search'." : null;
            } else {
                // Obtener todos los empleados si no hay término de búsqueda
                $empleados = Empleado::paginate(10);
                $mensaje = null; // No hay mensaje cuando no se realiza una búsqueda
            }

            return view('usuarios.empleado.index', compact('empleados', 'mensaje'));
        } catch (\Exception $e) {
            return redirect()->route('usuarios.empleado.index')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }
}
