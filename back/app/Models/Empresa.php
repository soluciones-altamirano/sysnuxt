<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Empresa
 * @package App\Models
 * @version November 3, 2019, 6:28 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection responsable
 * @property \Illuminate\Database\Eloquent\Collection sucursales
 * @property \Illuminate\Database\Eloquent\Collection users
 * @property string nombre
 * @property string direccion
 * @property string telefono
 * @property string email
 * @property string slug
 * @property string slogan
 */
class Empresa extends Model
{

    public $table = 'empresas';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'email',
        'slug',
        'slogan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'direccion' => 'string',
        'telefono' => 'string',
        'email' => 'string',
        'slug' => 'string',
        'slogan' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'direccion' => 'required',
        'telefono' => 'required',
        'email' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function responsable()
    {
        return $this->belongsToMany(\App\Models\User::class, 'empresa_responsable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function sucursales()
    {
        return $this->hasMany(\App\Models\Sucursale::class, 'empresa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function users()
    {
        return $this->hasMany(\App\Models\User::class, 'empresa_id');
    }
}
