<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductVariant;
use Faker\Generator as Faker;

$factory->define(ProductVariant::class, function (Faker $faker) {
    return [
        'product_id' => factory(\App\Product::class),
        'price_in_cents' => $faker->randomNumber(),
        'is_master' => $faker->boolean,
    ];
});
