<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Option
 * @package App\Models
 * @version November 4, 2019, 1:09 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection users
 * @property integer option_id
 * @property string nombre
 * @property string ruta
 * @property string descripcion
 * @property string icono_l
 * @property string icono_r
 * @property integer orden
 */
class Option extends Model
{

    public $table = 'options';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $with = ['children'];

    protected $appends= ['name'];

    public $fillable = [
        'option_id',
        'nombre',
        'ruta',
        'descripcion',
        'icono_l',
        'icono_r',
        'orden'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'option_id' => 'integer',
        'nombre' => 'string',
        'ruta' => 'string',
        'descripcion' => 'string',
        'icono_l' => 'string',
        'icono_r' => 'string',
        'orden' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'ruta' => 'required',
        'icono_l' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'option_user');
    }

    public function children()
    {
        return $this->hasMany(Option::class,'option_id','id');
    }

    public function getNameAttribute()
    {
        return $this->nombre;
    }
}
