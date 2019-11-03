<?php

use App\Models\Empresa;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Empresa::class,10)->create()->each(function (Empresa $empresa){

            $user = User::noResponsables()->get()->random()->id;

            $empresa->responsable()->attach($user, ['asignado' => Carbon::now() ]);

        });
    }
}
