<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use App\Models\Tratamiento;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Cita;
use App\Models\FacturaProducto;
use Illuminate\Database\Eloquent\ModelNotFoundException;


/**
 * Controlador para manejar las operaciones relacionadas con las facturas.
 */
class FacturaController extends Controller
{

    /**
     * Muestra una lista de todas las facturas.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $facturas = Factura::all();
        return view('facturas.index', compact('facturas'));
    }



    /**
     * Muestra el formulario para crear una nueva factura.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $clientes = Cliente::with('citas')->get();
        $productos = Producto::all(); // Obtener todos los productos
        return view('facturas.create', compact('clientes', 'productos'));
    }


    /**
     * Crea una nueva factura con los datos proporcionados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function crearFactura(Request $request)
    {
        try {
            // Validar los datos del formulario
            $request->validate([
                'cita_id' => 'required|integer|exists:cita,id', // Asegúrate de que la cita exista en la base de datos
                'productos.*.producto_id' => 'required|integer|exists:producto,id', // Asegúrate de que los productos existan en la base de datos
                'productos.*.cantidad' => 'required|integer', // Asegúrate de que la cantidad sea al menos 1
                // Agrega más validaciones según sea necesario para otros campos del formulario
            ]);

            // Buscar la cita por el ID proporcionado
            $cita = Cita::findOrFail($request->cita_id);

            // Obtener el precio del tratamiento
            $precio_tratamiento = $cita->tratamiento->precio;

            // Calcular el total de los productos
            $total_productos = 0;
            foreach ($request->productos as $producto) {
                $productoModel = Producto::findOrFail($producto['producto_id']);
                $total_productos += $productoModel->precio * $producto['cantidad'];
            }

            // Calcular el total de la factura
            $total_factura = $precio_tratamiento + $total_productos;

            // Crear la factura
            $factura = new Factura();
            $factura->cliente_id = $cita->cliente_id;
            $factura->cita_id = $cita->id;
            $factura->fecha_emision = now(); // Suponiendo que la fecha de emisión es la fecha actual
            $factura->tratamiento_id = $cita->tratamiento_id;
            $factura->total_tratamiento = $precio_tratamiento;
            $factura->total_factura = $total_factura;
            $factura->save();

            // Crear registros en la tabla intermedia factura_producto
            foreach ($request->productos as $producto) {
                $facturaProducto = new FacturaProducto();
                $facturaProducto->factura_id = $factura->id;
                $facturaProducto->producto_id = $producto['producto_id'];
                $facturaProducto->cantidad_producto = $producto['cantidad'];
                $productoModel = Producto::findOrFail($producto['producto_id']);
                $facturaProducto->precio_producto_unitario = $productoModel->precio;
                $facturaProducto->total_producto = $productoModel->precio * $producto['cantidad'];
                $facturaProducto->save();
            }

            // Redirigir a una página de éxito o hacer otra acción según sea necesario
            return redirect()->route('facturas.index')->with('success', 'La factura se ha creado con éxito.');
        } catch (\Exception $e) {
            // Manejar el error y devolver un mensaje de error
            return back()->withInput()->with('error', 'Ha ocurrido un error al crear la factura: ' . $e->getMessage());
        }
    }


    /**
     * Muestra los detalles de una factura específica.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $factura = Factura::findOrFail($id);
        $iva = 0.21; // Suponiendo que el IVA es del 21%
        $totalFacturaConIva = $factura->total_factura * (1 + $iva); // Calcula el total de la factura con IVA
        return view('facturas.show', compact('factura', 'iva', 'totalFacturaConIva'));
    }


    /**
     * Muestra el formulario para editar una factura específica.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $factura = Factura::findOrFail($id);
        $tratamientos = Tratamiento::all();
        $productos = Producto::all();

        return view('facturas.edit', compact('factura', 'tratamientos', 'productos'));
    }


    /**
     * Actualiza una factura existente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // Buscar la factura por su ID
            $factura = Factura::findOrFail($id);

            // Actualizar los campos modificables de la factura
            $factura->fecha_emision = $request->input('fecha_emision');
            $factura->total_tratamiento = $request->input('total_tratamiento');
            $factura->nombre_tratamiento = $request->input('nombre_tratamiento');
            $factura->cantidad_producto = $request->input('cantidad_producto');
            $factura->precio_unitario_producto = $request->input('precio_unitario_producto');
            $factura->total_producto = $request->input('total_producto');

            // Guardar los cambios en la base de datos
            $factura->save();

            // Redireccionar a la vista de detalles de la factura actualizada
            return redirect()->route('facturas.show', $factura->id)->with('success', 'La factura se ha actualizado correctamente.');
        } catch (\Exception $e) {
            // Manejar cualquier error que ocurra durante la actualización
            return redirect()->back()->with('error', 'Ha ocurrido un error al actualizar la factura: ' . $e->getMessage());
        }
    }


    /**
     * Elimina una factura de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $factura = Factura::findOrFail($id);

            // Eliminar los productos asociados a la factura
            $factura->productos()->detach();

            // Eliminar la factura
            $factura->delete();

            return redirect()->route('facturas.index')->with('success', 'Factura eliminada correctamente');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('facturas.index')->with('error', 'No se pudo encontrar la factura');
        } catch (\Exception $e) {
            return redirect()->route('facturas.index')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }



    /**
     * Define la relación con los productos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'factura_producto', 'factura_id', 'producto_id')
            ->withPivot('cantidad_producto', 'precio_producto_unitario', 'total_producto');
    }



    /**
     * Busca facturas por el dni del cliente y muestra los resultados paginados.
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
                    return redirect()->route('facturas.index')->with('error', 'El formato del DNI es incorrecto. Debe tener 8 dígitos seguidos de una letra.');
                }
    
                // Verificar si el cliente con el DNI proporcionado existe en la base de datos
                $cliente = Cliente::whereHas('user', function ($query) use ($search) {
                    $query->where('DNI', $search);
                })->first();
    
                if (!$cliente) {
                    return redirect()->route('facturas.index')->with('error', 'El DNI proporcionado no se encuentra en la base de datos.');
                }
    
                // Buscar las facturas por el DNI del cliente
                $facturas = Factura::join('cliente', 'factura.cliente_id', '=', 'cliente.id')
                    ->join('users', 'cliente.user_id', '=', 'users.id')
                    ->where('users.DNI', $search)
                    ->paginate(10);
                
                // Verificar si no se encontraron facturas con el DNI del cliente buscado
                $mensaje = $facturas->isEmpty() ? "No se encontraron facturas con el DNI '$search'." : null;
            } else {
                // Obtener todas las facturas si no hay término de búsqueda
                $facturas = Factura::paginate(10);
                $mensaje = null; // No hay mensaje cuando no se realiza una búsqueda
            }
    
            return view('facturas.index', compact('facturas', 'mensaje'));
        } catch (\Exception $e) {
            return redirect()->route('facturas.index')->with('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }
    
    
    
    
    


    /**
     * Obtiene las citas de un cliente por su DNI.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $dni
     * @return \Illuminate\Http\Response
     */
    public function obtenerCitasPorDni($dni)
    {
        try {
            // Buscar el cliente por su DNI
            $cliente = Cliente::whereHas('user', function ($query) use ($dni) {
                $query->where('DNI', $dni);
            })->firstOrFail();

            // Buscar las citas del cliente por su ID
            $citas = Cita::where('cliente_id', $cliente->id)->get();

            // Devolver las citas en formato JSON
            return response()->json($citas);
        } catch (ModelNotFoundException $e) {
            // Cliente no encontrado, devolver un mensaje de error
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        } catch (\Exception $e) {
            // Manejar cualquier otro error y devolver un mensaje de error genérico
            return response()->json(['error' => 'Ha ocurrido un error al procesar la solicitud'], 500);
        }
    }
}
