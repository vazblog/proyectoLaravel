<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;


/**
 * Controlador para manejar las operaciones relacionadas con los productos.
 */
class ProductoController extends Controller
{

    /**
     * Muestra una lista de todos los productos.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        try {
            if (Auth::check()) {
                $productos = Producto::paginate(10);
                return view('productos.index', compact('productos'));
            } else {
                return view('productos.productos');
            }
        } catch (\Exception $e) {
            return redirect()->route('productos.index')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }


    /**
     * Muestra el formulario para crear un nuevo producto.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('productos.create');
    }


    /**
     * Almacena un nuevo producto con los datos proporcionados.
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
                'stock' => 'required|integer',
            ]);

            Producto::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'stock' => $request->stock,
            ]);
            return redirect()->route('productos.index')->with('success', 'Producto creado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('productos.index')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }


    /**
     * Elimina un producto de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $producto = Producto::findOrFail($id);
            $producto->delete();
            return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('productos.index')->with('error', 'No se pudo encontrar el producto');
        } catch (\Exception $e) {
            return redirect()->route('productos.index')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }


    /**
     * Busca productos por su nombre y muestra los resultados paginados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function buscar(Request $request)
    {
        try {
            $search = $request->input('search');
            if ($search) {
                $productos = Producto::where('nombre', $search)->paginate(10);
            } else {
                $productos = Producto::paginate(10);
            }
            if ($productos->isEmpty()) {
                $mensaje = "No se encontraron productos con el nombre '$search'.";
            }
            return view('productos.index', compact('productos'));
        } catch (\Exception $e) {
            return redirect()->route('productos.index')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }


    /**
     * Muestra el formulario para editar un producto específico.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        try {
            $producto = Producto::findOrFail($id);
            return view('productos.edit', compact('producto'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('productos.index')->with('error', 'No se pudo encontrar el producto');
        } catch (\Exception $e) {
            return redirect()->route('productos.index')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    /**
     * Actualiza un producto existente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $producto = Producto::find($id);

            if ($producto) {
                $request->validate([
                    'nombre' => 'required|string|max:255',
                    'descripcion' => 'required|string',
                    'precio' => 'required|numeric',
                    'stock' => 'required|integer',
                ]);

                $producto->update([
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                    'precio' => $request->precio,
                    'stock' => $request->stock,
                ]);
            }


            return redirect()->route('productos.index')->with('success', '¡Producto actualizado correctamente!');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('productos.index')->with('error', 'No se pudo encontrar el producto');
        } catch (\Exception $e) {
            return redirect()->route('productos.index')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }
}
