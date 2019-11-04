<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Option;
use Faker\Generator as Faker;

$factory->define(Option::class, function (Faker $faker) {
    return [
        'option_id' => null,
        'nombre' => $faker->word,
        'ruta' => $faker->domainName,
        'descripcion' => $faker->text,
        'icono_l' => $faker->randomElement([
             'mdi-language-html5',
             'mdi-nodejs',
             'mdi-json',
             'mdi-markdown',
             'mdi-file-pdf',
             'mdi-file-image',
             'mdi-file-document-outline',
             'mdi-file-excel',
        ]),
        'icono_r' => null,
        'orden' => rand(0,10)
    ];
});
