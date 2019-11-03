<?php

namespace App\Models;

use App\Traits\GlobalScopeEmpresa;
use App\User;
use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Sucursal
 * @package App\Models
 * @version November 3, 2019, 10:07 pm UTC
 *
 * @property \App\Models\Empresa empresa
 * @property \Illuminate\Database\Eloquent\Collection admins
 * @property \Illuminate\Database\Eloquent\Collection users
 * @property string nombre
 * @property string direccion
 * @property string telefono
 * @property string email
 * @property string slug
 * @property integer empresa_id
 */
class Sucursal extends Model
{

    use SoftDeletes,GlobalScopeEmpresa;

    public $table = 'sucursales';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'email',
        'slug',
        'empresa_id'
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
        'empresa_id' => 'integer'
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
        'email' => 'required',
//        'empresa_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function admins()
    {
        return $this->belongsToMany(User::class, 'sucursal_admin');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function users()
    {
        return $this->hasMany(User::class, 'sucursal_id');
    }
}
