<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\ProductVariant;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $name = $faker->name;

    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'description' => $faker->text,
        'featured' => $faker->boolean,
    ];
});

$factory->state(Product::class, 'featured', [
    'featured' => 1,
]);
