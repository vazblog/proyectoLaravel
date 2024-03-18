<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo para representar una factura.
 */
class Factura extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'cliente_id',
        'cita_id',
        'fecha_emision',
        'tratamiento_id',
        'total_tratamiento',
        'total_factura'

    ];

    /**
     * Opcional: Si deseas establecer el nombre de la tabla manualmente.
     *
     * @var string
     */
    protected $table = 'factura';

    /**
     * Define la relación con el modelo Cliente.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }


    /**
     * Define la relación con el modelo Cita.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cita()
    {
        return $this->belongsTo(Cita::class, 'cita_id');
    }

    /**
     * Define la relación con el modelo Tratamiento.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tratamiento()
    {
        return $this->belongsTo(Tratamiento::class, 'tratamiento_id');
    }

    /**
     * Define la relación con el modelo Producto.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'factura_producto', 'factura_id', 'producto_id')
            ->withPivot('cantidad_producto', 'precio_producto_unitario', 'total_producto');
    }
}
