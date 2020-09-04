<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductPropertyType;
use Faker\Generator as Faker;

$factory->define(ProductPropertyType::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
