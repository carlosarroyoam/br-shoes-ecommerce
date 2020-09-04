<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\ProductVariant;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'slug' => $faker->slug,
        'description' => $faker->text,
        'featured' => $faker->boolean,
    ];
});

$factory->afterCreating(Product::class, function ($product, $faker) {
    $product->productVariants()->save(
        factory(ProductVariant::class)->states('is_master')->make()
    );
});

$factory->state(ProductVariant::class, 'featured', [
    'featured' => 1,
]);
