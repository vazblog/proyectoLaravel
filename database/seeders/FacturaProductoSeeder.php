<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacturaProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear relaciones entre facturas y productos
        $facturaProducto = [
            ['factura_id' => 1, 'producto_id' => 1, 'cantidad_producto' => 1, 'precio_producto_unitario' => 25.00, 'total_producto' => 25.00],
            ['factura_id' => 1, 'producto_id' => 2, 'cantidad_producto' => 2, 'precio_producto_unitario' => 15.00, 'total_producto' => 30.00],
            ['factura_id' => 2, 'producto_id' => 3, 'cantidad_producto' => 1, 'precio_producto_unitario' => 18.00, 'total_producto' => 18.00],
        ];

        // Insertar los datos en la tabla factura_producto
        foreach ($facturaProducto as $item) {
            DB::table('factura_producto')->insert($item);
        }
    }
}
