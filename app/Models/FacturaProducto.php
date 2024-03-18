<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo para representar la relación entre una factura y un producto.
 */
class FacturaProducto extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'factura_id',
        'producto_id',
        'cantidad_producto',
        'precio_producto_unitario',
        'total_producto'
    ];

    /**
     * Opcional: Si deseas establecer el nombre de la tabla manualmente.
     *
     * @var string
     */
    protected $table = 'factura_producto';

    /**
     * Define la relación con el modelo Factura.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function factura()
    {
        return $this->belongsTo(Factura::class, 'factura_id');
    }

    /**
     * Define la relación con el modelo Producto.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
