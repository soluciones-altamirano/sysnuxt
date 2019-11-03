<?php

use App\Models\Empresa;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RolsTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(EmpresaSeeder::class);
         $this->call(SucursalSeeder::class);

        foreach (User::all() as $index => $u) {

            $empresa = Empresa::whereHas('sucursales', function (Builder $query) {
                $query->withoutGlobalScope('empresa');
            })->get()->random();

            $sucursal_id = $empresa->sucursales(function (Builder $query){
                $query->withoutGlobalScope('empresa');
            })->get()->first()->id;

            $u->empresa_id = $empresa->id;
            $u->sucursal_id = $sucursal_id;
            $u->save();

        }
    }
}
