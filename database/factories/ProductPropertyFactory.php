<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductProperty;
use Faker\Generator as Faker;

$factory->define(ProductProperty::class, function (Faker $faker) {
    return [
        'product_id' => factory(\App\Product::class),
        'property_type_id' => factory(\App\ProductPropertyType::class),
        'value' => $faker->word,
    ];
});
