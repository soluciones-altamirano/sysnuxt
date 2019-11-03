<?php

use App\Models\Sucursal;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Sucursal::class,10)->create()->each(function (Sucursal $sucursal){


            $user = User::noAdminSucursal()->get()->random()->id;

            $sucursal->admins()->attach($user, ['asignado' => Carbon::now() ]);

        });
    }
}
