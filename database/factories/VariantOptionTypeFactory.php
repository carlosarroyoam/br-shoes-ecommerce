<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\VariantOptionType;
use Faker\Generator as Faker;

$factory->define(VariantOptionType::class, function (Faker $faker) {
    return [
        'product_id' => factory(\App\Product::class),
        'name' => $faker->name,
    ];
});
