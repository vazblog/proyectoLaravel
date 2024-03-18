<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tratamiento;
use Illuminate\Support\Facades\Auth;


/**
 * Controlador para manejar las operaciones relacionadas con los tratamientos.
 */
class TratamientoController extends Controller
{

    /**
     * Muestra una lista de todos los tratamientos.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        try {
            if (Auth::check()) {
                $tratamientos = Tratamiento::paginate(10);
                return view('tratamientos.index', compact('tratamientos'));
            } else {
                return view('tratamientos.tratamientos');
            }
        } catch (\Exception $e) {
            return redirect()->route('tratamientos.index')->with('error', 'Error al cargar los tratamientos: ' . $e->getMessage());
        }
    }


    /**
     * Muestra el formulario para crear un nuevo tratamiento.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('tratamientos.create');
    }


    /**
     * Almacena un nuevo tratamiento con los datos proporcionados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'precio' => 'required|numeric',
                'duracion' => 'required|integer',
            ]);


            Tratamiento::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'duracion' => $request->duracion,
            ]);

            return redirect()->route('tratamientos.index')->with('success', 'Tratamiento creado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('tratamientos.index')->with('error', 'Error al crear el tratamiento: ' . $e->getMessage());
        }
    }


    /**
     * Elimina un tratamiento de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $tratamiento = Tratamiento::find($id);

            if ($tratamiento) {
                $tratamiento->delete();
                return redirect()->route('tratamientos.index')->with('success', 'Tratamiento eliminado correctamente');
            } else {
                return redirect()->route('tratamientos.index')->with('error', 'No se pudo encontrar el tratamiento');
            }
        } catch (\Exception $e) {
            return redirect()->route('tratamientos.index')->with('error', 'Error al eliminar el tratamiento: ' . $e->getMessage());
        }
    }


    /**
     * Busca tratamientos por nombre y muestra los resultados paginados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function buscar(Request $request)
    {
        try {
            $search = $request->input('search');
            if ($search) {
                $tratamientos = Tratamiento::where('nombre', $search)->paginate(10);
            } else {
                $tratamientos = Tratamiento::paginate(10);
            }
            if ($tratamientos->isEmpty()) {
                $mensaje = "No se encontraron tratamientos con el nombre '$search'.";
            }

            return view('tratamientos.index', compact('tratamientos'));
        } catch (\Exception $e) {
            return redirect()->route('tratamientos.index')->with('error', 'Error al buscar tratamientos: ' . $e->getMessage());
        }
    }


    /**
     * Muestra el formulario para editar un tratamiento específico.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        try {
            $tratamiento = Tratamiento::find($id);

            if ($tratamiento) {
                return view('tratamientos.edit', compact('tratamiento'));
            } else {
                return redirect()->route('tratamientos.index')->with('error', 'No se pudo encontrar el tratamiento');
            }
        } catch (\Exception $e) {
            return redirect()->route('tratamientos.index')->with('error', 'Error al editar el tratamiento: ' . $e->getMessage());
        }
    }


    /**
     * Actualiza un tratamiento existente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $tratamiento = Tratamiento::find($id);

            if ($tratamiento) {
                $request->validate([
                    'nombre' => 'required|string|max:255',
                    'descripcion' => 'required|string',
                    'precio' => 'required|numeric',
                    'duracion' => 'required|integer',
                ]);

                $tratamiento->update([
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                    'precio' => $request->precio,
                    'duracion' => $request->duracion,
                ]);

                return redirect()->route('tratamientos.index')->with('success', '¡Tratamiento actualizado correctamente!');
            } else {
                return redirect()->route('tratamientos.index')->with('error', '¡No se pudo encontrar el tratamiento!');
            }
        } catch (\Exception $e) {
            return redirect()->route('tratamientos.index')->with('error', 'Error al actualizar el tratamiento: ' . $e->getMessage());
        }
    }
}
