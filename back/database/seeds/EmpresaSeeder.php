<?php

use App\Models\Empresa;
use Carbon\Carbon;
use http\Client\Curl\User;
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
        factory(App\Models\Empresa::class,10)->create()->each(function (Empresa $empresa){

            $user = \App\User::all()->random()->id;

            $empresa->responsable()->attach([$user = ['asignado' => Carbon::now() ] ]);

        });
    }
}
