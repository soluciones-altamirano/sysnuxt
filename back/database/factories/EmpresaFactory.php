<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Empresa;
use Faker\Factory;
use Faker\Generator as Faker;

$factory->define(Empresa::class, function () {

    $faker = Factory::create('es_ES');
    $nombre = $faker->company;

    return [
        'nombre' => $nombre,
        'direccion' => $faker->address,
        'telefono' => $faker->phoneNumber,
        'email' => $faker->email,
        'slug' => str_slug($nombre,'_'),
        'slogan' => $faker->realText(255)
    ];
});
