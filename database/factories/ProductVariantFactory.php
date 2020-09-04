<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductVariant;
use Faker\Generator as Faker;

$factory->define(ProductVariant::class, function (Faker $faker) {
    return [
        'price_in_cents' => $faker->randomNumber(),
        'is_master' => $faker->boolean,
    ];
});

$factory->state(ProductVariant::class, 'is_master', [
    'is_master' => 1,
]);
