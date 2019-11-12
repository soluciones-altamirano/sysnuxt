<?php

namespace App;

use App\Models\Empresa;
use App\Models\Sucursal;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\Option;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 * @package App\Models
 * @version November 3, 2019, 9:52 pm UTC
 *
 * @property \App\Models\Empresa empresa
 * @property \App\Models\Sucursale sucursal
 * @property \Illuminate\Database\Eloquent\Collection empresas
 * @property \Illuminate\Database\Eloquent\Collection options
 * @property \Illuminate\Database\Eloquent\Collection sucursales
 * @property string name
 * @property string username
 * @property string email
 * @property string|\Carbon\Carbon email_verified_at
 * @property string password
 * @property integer empresa_id
 * @property integer sucursal_id
 * @property string remember_token
 */
class User extends Authenticatable
{
    use HasApiTokens,Notifiable,HasRoles,SoftDeletes;

    protected $with = ['permissions','options'];

    protected $appends = ['all_permissions','img'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','name', 'email', 'password','empresa_id','sucursal_id','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function findForPassport($identifier) {
        return $this->orWhere('email', $identifier)->orWhere('username', $identifier)->first();
    }

    public static $rules = [
        'name'     => 'required|max:255',
        'username' => 'sometimes|required|max:255|unique:users',
        'email'    => 'required|email|max:255',
        'password' => 'required|min:6|confirmed',
    ];


    public function getAllPermissionsAttribute()
    {
        return $this->getAllPermissions()->pluck('name');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function empresas()
    {
        return $this->belongsToMany(Empresa::class, 'empresa_responsable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function options()
    {
        return $this->belongsToMany(Option::class, 'option_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function sucursales()
    {
        return $this->belongsToMany(Sucursal::class, 'sucursal_admin');
    }

    public function scopeNoResponsables($query)
    {
        $query->whereDoesntHave('empresas',function ($q){
            $q->whereNull('desasignado');
        });
    }


    public function scopeNoAdminSucursal($query)
    {
        $query->whereDoesntHave('sucursales',function ($q){
            $q->whereNull('desasignado');
        });
    }


    public function getImgAttribute()
    {
        return is_null($this->avatar) ? asset('img/avatar_none.png') : asset('storage/avatars/'.$this->avatar);
    }
}
