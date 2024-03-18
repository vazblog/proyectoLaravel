<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Empleado;
use App\Models\User;
use App\Models\Tratamiento;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

/**
 * Controlador para gestionar las operaciones relacionadas con las citas del sistema.
 */
class CitaController extends Controller
{


    /**
     * Muestra la lista de todas las citas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            if (Auth::check()) {
                $citas = Cita::paginate(10);
                return view('citas.index', compact('citas'));
            } else {
                return view('citas.citas');
            }
        } catch (\Exception $e) {
            return redirect()->route('citas.index')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }


    /**
     * Muestra el formulario para crear una nueva cita.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tratamientos = Tratamiento::all();
        $empleados = Empleado::all();

        return view('citas.create', compact('tratamientos', 'empleados'));
    }




    /**
     * Almacena una nueva cita en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            // Validación de los datos del formulario
            $validator = Validator::make($request->all(), [
                'nombre_cliente' => 'required|string|max:255',
                'dni_cliente' => 'required|string|min:9|max:9',
                'fecha' => 'required|date_format:Y-m-d|after_or_equal:today|before_or_equal:' . \Carbon\Carbon::now()->addYear()->format('Y-m-d'),
                'hora' => 'required|date_format:H:i',
                'tratamiento' => 'required|exists:tratamiento,id',
                'empleado' => 'required|exists:empleado,id',
                'observaciones' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Verificar si existe un usuario cliente con el DNI proporcionado
            $cliente = User::where('dni', $request->dni_cliente)->first();

            if (!$cliente || !$cliente->perfil || $cliente->perfil->tipo !== 'cliente') {
                return redirect()->back()->withInput()->withErrors(['dni_cliente' => 'El cliente no fue encontrado en la base de datos.']);
            }

            // Verificar que el nombre proporcionado coincide con el cliente que tiene el DNI proporcionado
            if ($cliente->name !== $request->nombre_cliente) {
                return redirect()->back()->withInput()->withErrors(['nombre_cliente' => 'El nombre proporcionado no coincide con el cliente asociado al DNI.']);
            }



            $fecha_hora = $request->fecha . ' ' . $request->hora;

            $citaExistenteEmpleado = DB::table('cita')
                ->where('fecha_hora', $fecha_hora)
                ->where('empleado_id', $request->empleado)
                ->exists();

            if ($citaExistenteEmpleado) {
                return redirect()->route('citas.create')->with('error', 'El empleado ya tiene una cita a esa misma fecha y hora.');
            }

            $citaExistenteCliente = DB::table('cita')
                ->join('cliente', 'cita.cliente_id', '=', 'cliente.id')
                ->join('users', 'cliente.user_id', '=', 'users.id')
                ->where('users.name', $request->nombre_cliente)
                ->where('fecha_hora', $fecha_hora)
                ->exists();

            if ($citaExistenteCliente) {
                return redirect()->route('citas.create')->with('error', 'El cliente ya tiene una cita a esa misma fecha y hora.');
            }


            $cliente = DB::table('cliente')
                ->join('users', 'cliente.user_id', '=', 'users.id')
                ->where('users.name', $request->nombre_cliente)
                ->select('cliente.id')
                ->first();

            if (!$cliente) {

                return back()->with('error', 'El cliente no fue encontrado en la base de datos.');
            }


            $cita = new Cita();
            $cita->cliente_id = $cliente->id;
            $cita->fecha_hora = $fecha_hora;
            $cita->tratamiento_id = $request->tratamiento;
            $cita->empleado_id = $request->empleado;
            $cita->observaciones = $request->observaciones;
            $cita->save();


            // Verificar si el usuario es un cliente
            if (Auth::check() && Auth::user()->perfil && Auth::user()->perfil->tipo === 'cliente') {
                // Redirigir al usuario a la vista de sus citas con un mensaje de éxito
                // return redirect()->route('citas.show')->with('success', 'Cita creada exitosamente.');
                return redirect()->route('citas.show', ['id' => $cita->id])->with('success', 'Cita creada exitosamente.');
            } else {
                // Redirigir al usuario al índice de todas las citas
                return redirect()->route('citas.index')->with('success', 'Cita creada exitosamente.');
            }
        } catch (ModelNotFoundException $e) {
            return redirect()->route('citas.index')->with('error', 'No se pudo encontrar la cita');
        } catch (\Exception $e) {

            return redirect()->route('citas.index')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }


    /**
     * Actualiza los datos de una cita existente en la base de datos.
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
                'fecha' => 'required|date_format:Y-m-d|after_or_equal:today|before_or_equal:' . \Carbon\Carbon::now()->addYear()->format('Y-m-d'),
                'hora' => 'required|date_format:H:i',
                'tratamiento_id' => 'required|exists:tratamiento,id',
                'empleado_id' => 'required|exists:empleado,id',
                'observaciones' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }


            $cita = Cita::findOrFail($id);

            if (!$cita) {
                return redirect()->route('citas.index')->with('error', 'No se pudo encontrar la cita');
            }


            $fecha_hora = $request->fecha . ' ' . $request->hora;


            // Verificar si el usuario actual es un cliente
            $esCliente = Auth::user()->perfil && Auth::user()->perfil->tipo === 'cliente';

            // Si el usuario actual es un cliente, verifica si está modificando su propia cita
            if ($esCliente && $cita->cliente->user_id !== Auth::id()) {
                return redirect()->route('citas.show', ['id' => $cita->id])->with('error', 'No tienes permiso para modificar esta cita');
            }

            // Verificar la existencia de citas con la misma fecha y hora para el empleado y el cliente
            $citaExistenteEmpleado = Cita::where('fecha_hora', $fecha_hora)
                ->where('empleado_id', $request->empleado_id)
                ->where('id', '!=', $id)
                ->exists();

            if ($citaExistenteEmpleado) {
                return redirect()->route('citas.edit', $cita->id)->with('error', 'El empleado ya tiene una cita a esa misma fecha y hora.');
            }

            $cita->fecha_hora = $fecha_hora;
            $cita->tratamiento_id = $request->tratamiento_id;
            $cita->empleado_id = $request->empleado_id;
            $cita->observaciones = $request->observaciones;

            $cita->save();

            // Redirigir al usuario a la vista correspondiente con un mensaje de éxito
            if ($esCliente) {
                return redirect()->route('citas.show', ['id' => $cita->id])->with('success', 'Cita modificada exitosamente.');
            } else {
                return redirect()->route('citas.index')->with('success', 'Cita modificada exitosamente.');
            }
        } catch (ModelNotFoundException $e) {
            return redirect()->route('citas.index')->with('error', 'No se pudo encontrar la cita');
        } catch (\Exception $e) {

            return redirect()->route('citas.index')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }


    /**
     * Elimina una cita de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $cita = Cita::findOrFail($id);
            $cita->delete();
            // Verificar si el usuario es un cliente
            if (Auth::check() && Auth::user()->perfil && Auth::user()->perfil->tipo === 'cliente') {
                // Redirigir al usuario a la vista de sus citas con un mensaje de éxito
                return redirect()->route('citas.show', ['id' => $cita->id])->with('success', 'Cita eliminada exitosamente.');
            } else {
                // Redirigir al usuario al índice de todas las citas
                return redirect()->route('citas.index')->with('success', 'Cita eliminada correctamente.');
            }
        } catch (ModelNotFoundException $e) {
            return redirect()->route('citas.index')->with('error', 'No se pudo encontrar la cita');
        } catch (\Exception $e) {
            return redirect()->route('citas.index')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    /**
     * Busca citas por nombre de cliente.
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
                    return redirect()->route('citas.index')->with('error', 'El formato del DNI es incorrecto. Debe tener 8 dígitos seguidos de una letra.');
                }

                // Verificar si el cliente con el DNI proporcionado existe en la base de datos
                $cliente = Cliente::whereHas('user', function ($query) use ($search) {
                    $query->where('DNI', $search);
                })->first();

                if (!$cliente) {
                    return redirect()->route('citas.index')->with('error', 'El DNI proporcionado no se encuentra en la base de datos.');
                }

                // Buscar las citas del cliente por su DNI
                $citas = Cita::where('cliente_id', $cliente->id)->paginate(10);

                // Verificar si no se encontraron citas con el DNI del cliente buscado
                $mensaje = $citas->isEmpty() ? "No se encontraron citas para el cliente con el DNI '$search'." : null;
            } else {
                // Obtener todas las citas si no hay término de búsqueda
                $citas = Cita::paginate(10);
                $mensaje = null; // No hay mensaje cuando no se realiza una búsqueda
            }

            return view('citas.index', compact('citas', 'mensaje'));
        } catch (\Exception $e) {
            return redirect()->route('citas.index')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }





    /**
     * Muestra el formulario para editar una cita existente.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $cita = Cita::findOrFail($id);
            $tratamientos = Tratamiento::all();
            $empleados = Empleado::all();

            return view('citas.edit', compact('cita', 'tratamientos', 'empleados'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('citas.index')->with('error', 'No se pudo encontrar la cita');
        } catch (\Exception $e) {
            return redirect()->route('citas.index')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }



    /**
     * Muestra las citas del cliente actualmente autenticado.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        if (Auth::check()) {
            $cliente = Auth::user()->cliente;

            if ($cliente) {
                $citas = $cliente->citas;
            } else {
                $citas = null;
            }

            return view('citas.show', compact('citas'));
        } else {
        }
    }



    public function citaImprimir($id)
    {
        $cita = Cita::findOrFail($id);

        return view('citas.imprimir', compact('cita'));
    }
}
