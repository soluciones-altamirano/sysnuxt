<?php

use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Option::class,1)->create([
            'nombre' => 'Admin',
            'icono_l' => 'mdi-folder-open',
            'ruta' => ''
        ])->each(function (Option $option){
            factory(Option::class,1)->create([
                'option_id' => $option->id,
                'nombre' => 'Usuarios',
                'icono_l' => 'mdi-account',
                'ruta' => '/admin/users'
            ]);

            factory(Option::class,1)->create([
                'option_id' => $option->id,
                'nombre' => 'Empresas',
                'icono_l' => 'mdi-domain',
                'ruta' => '/admin/empresas'
            ]);

            factory(Option::class,1)->create([
                'option_id' => $option->id,
                'nombre' => 'Sucursales',
                'icono_l' => 'mdi-store',
                'ruta' => '/admin/sucursales'
            ]);

            factory(Option::class,1)->create([
                'option_id' => $option->id,
                'nombre' => 'Menu',
                'icono_l' => 'mdi-format-list-bulleted-type',
                'ruta' => '/admin/menu'
            ]);
        });


        if (app()->environment()=='local'){

            factory(Option::class,10)->create(['ruta' => ''])->each(function (Option $option){
                factory(Option::class,rand(1,5))->create(['ruta' => '','option_id' => $option->id])->each(function (Option $option){
                    factory(Option::class,rand(1,5))->create(['option_id' => $option->id]);
                });
            });

        }

    }
}
