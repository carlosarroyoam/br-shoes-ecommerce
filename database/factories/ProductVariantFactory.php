<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductVariant;
use Faker\Generator as Faker;

$factory->define(ProductVariant::class, function (Faker $faker) {
    return [
        'price_in_cents' => $faker->numberBetween(15000, 85000),
        'is_master' => false,
    ];
});

$factory->state(ProductVariant::class, 'is_master', [
    'is_master' => true,
]);
