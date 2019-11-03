<?php


namespace App\Traits;


use App\Models\Empresa;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;


trait GlobalScopeEmpresa
{

    public static function bootGlobalScopeEmpresa()
    {
        static::addGlobalScope('empresa', function (Builder $builder) {

            if (!App::runningInConsole() && auth()->user()){

                $empresa = auth()->user()->empresa_id;

                $builder->where('empresa_id', $empresa );
            }


        });
    }
}
