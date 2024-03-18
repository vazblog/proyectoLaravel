<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo para representar los productos.
 */
class Producto extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'descripcion', 'precio', 'stock'];

    /**
     * Opcional: Si deseas establecer el nombre de la tabla manualmente.
     *
     * @var string
     */
    protected $table = 'producto';
}
