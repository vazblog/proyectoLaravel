<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Modelo para representar un empleado.
 */
class Empleado extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'salario',
        'rol_empleado',
    ];

    /**
     * Opcional: Si deseas establecer el nombre de la tabla manualmente.
     *
     * @var string
     */
    protected $table = 'empleado';

    /**
     * Define la relación con el modelo User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
