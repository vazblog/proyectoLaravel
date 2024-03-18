<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Perfil;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;

/**
 * Controlador para gestionar las operaciones relacionadas con los administradores del sistema.
 */
class AdminController extends Controller
{

    /**
     * Muestra la lista de administradores.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            if (Auth::check()) {
                // Consultar los administradores desde la tabla de usuarios filtrando por el perfil de administrador
                $administradores = User::where('perfil_id', Perfil::where('tipo', 'administrador')->value('id'))->paginate(10);
                return view('usuarios.administrador.index', compact('administradores'));
            } else {
                return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
            }
        } catch (\Exception $e) {
            return redirect()->route('usuarios.administrador.index')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    /**
     * Muestra el formulario para crear un nuevo administrador.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.administrador.create');
    }

    /**
     * Almacena un nuevo administrador en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

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
                'email' => 'required|email|max:255',
                'telefono' => 'required|integer|digits:9',
                'direccion' => 'required|string|max:255',
                'cp' => 'required|integer|digits:5',
                'DNI' => 'required|string|max:9|regex:/^\d{8}[a-zA-Z]$/',
                'password' => 'required|string|min:8|confirmed',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,tmp|max:2048',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }


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
                'perfil_id' => Perfil::where('tipo', 'administrador')->value('id')
            ]);




            if ($request->file('photo')) {
                $file = $request->file('photo');
                $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
                $file->move(public_path('upload/admin_images'), $filename);
                $usuario->photo = $filename;
                $usuario->save();
            }

            return redirect()->route('usuarios.administrador.index')->with('success', 'Administrador creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error al crear el administrador: ' . $e->getMessage());
        }
    }



    /**
     * Muestra los detalles de un administrador específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('usuarios.administrador.show', ['user' => $user]);
    }


    /**
     * Muestra el formulario para editar un administrador.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('usuarios.administrador.edit', compact('user'));
    }

    /**
     * Actualiza los datos de un administrador en la base de datos.
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
                'name' => 'required|string|max:255',
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
                'photo' => 'image|mimes:jpeg,png,jpg,gif,tmp|max:2048',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Encontrar al usuario administrador a actualizar
            $admin = User::findOrFail($id);

            // Actualizar los campos del usuario administrador
            $admin->update([
                'name' => $request->name,
                'apellido_uno' => $request->apellido_uno,
                'apellido_dos' => $request->apellido_dos,
                'fecha_nac' => $request->fecha_nac,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'cp' => $request->cp,
                'poblacion' => $request->poblacion,
                'DNI' => $request->DNI,
                'password' => $request->password ? Hash::make($request->password) : $admin->password,
            ]);

            // Guardar la imagen de perfil del usuario si se ha proporcionado
            if ($request->file('photo')) {
                $file = $request->file('photo');
                $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
                $file->move(public_path('upload/admin_images'), $filename);
                $admin->photo = $filename;
                $admin->save();
            }



            // Redirigir a la página de detalles del administrador actualizado
            return redirect()->route('usuarios.administrador.index', $admin->id)->with('success', 'Usuario administrador actualizado exitosamente.');
        } catch (\Exception $e) {
            // Manejo de excepciones
            return redirect()->back()->withInput()->with('error', 'Error al modificar el administrador: ' . $e->getMessage());
        }
    }



    /**
     * Elimina un administrador de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*  
    public function destroy($id)
    {
        try {
            // Buscar el usuario por su ID
            $usuario = User::findOrFail($id);

            // Verificar si el usuario tiene un perfil de administrador
            if ($usuario->perfil->tipo === 'administrador') {
                // Eliminar el usuario
                $usuario->delete();
                return redirect()->route('usuarios.administrador.index')->with('success', 'El usuario administrador ha sido eliminado correctamente.');
            } else {
                return redirect()->route('usuarios.administrador.index')->with('error', 'El usuario no tiene el perfil de administrador.');
            }
        } catch (\Exception $e) {
            return redirect()->route('usuarios.administrador.index')->with('error', 'Ha ocurrido un error al eliminar el usuario administrador: ' . $e->getMessage());
        }
    }
    */


    public function destroy($id)
    {
        try {
            // Buscar el usuario por su ID
            $usuario = User::findOrFail($id);

            // Verificar si el usuario tiene un perfil de administrador
            if ($usuario->perfil->tipo === 'administrador') {
                // Verificar si el usuario que se está eliminando es el usuario autenticado
                if ($usuario->id === Auth::id()) {
                    // Cerrar la sesión del usuario autenticado
                    Auth::logout();

                    // Eliminar al usuario
                    $usuario->delete();

                    return redirect()->route('inicio')->with('success', 'Tu cuenta de administrador ha sido eliminada correctamente.');
                } else {
                    // Si no es el usuario autenticado, eliminar al usuario normalmente
                    $usuario->delete();
                    return redirect()->route('usuarios.administrador.index')->with('success', 'El usuario administrador ha sido eliminado correctamente.');
                }
            } else {
                return redirect()->route('usuarios.administrador.index')->with('error', 'El usuario no tiene el perfil de administrador.');
            }
        } catch (\Exception $e) {
            return redirect()->route('usuarios.administrador.index')->with('error', 'Ha ocurrido un error al eliminar el usuario administrador: ' . $e->getMessage());
        }
    }






    /**
     * Busca administradores por DNI.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function buscar(Request $request)
    {
        try {
            $search = $request->input('search');

            if ($search) {
                // Buscar los administradores por DNI
                $administradores = User::whereHas('perfil', function ($query) use ($search) {
                    $query->where('tipo', 'administrador')
                        ->where('dni', $search);
                })->paginate(10);
            } else {
                // Obtener todos los administradores si no hay término de búsqueda
                $administradores = User::whereHas('perfil', function ($query) {
                    $query->where('tipo', 'administrador');
                })->paginate(10);
            }

            // Verificar si no se encontraron administradores con el DNI buscado
            $mensaje = $administradores->isEmpty() ? "No se encontraron administradores con el DNI '$search'." : null;

            return view('usuarios.administrador.index', compact('administradores', 'mensaje'));
        } catch (\Exception $e) {
            return redirect()->route('usuarios.administrador.index')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }
}
