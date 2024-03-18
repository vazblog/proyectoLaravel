<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo para representar los perfiles de usuario.
 */
class Perfil extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = ['descripcion', 'tipo'];

    /**
     * Opcional: Si deseas establecer el nombre de la tabla manualmente.
     *
     * @var string
     */
    protected $table = 'perfiles';


    /**
     * Define la relación con el modelo User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usuarios()
    {
        return $this->hasMany(User::class, 'perfil_id');
    }
}
