<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Empresa;
use App\Models\Sucursal;
use Faker\Factory;
use Faker\Generator as Faker;

$factory->define(Sucursal::class, function () {

    $faker = Factory::create('es_ES');

    $nombre = $faker->company;

    return [
        'nombre' => $nombre,
        'direccion' => $faker->address,
        'telefono' => $faker->phoneNumber,
        'email' => $faker->email,
        'slug' => str_slug($nombre),
        'empresa_id' => Empresa::all()->random()->id
    ];
});
