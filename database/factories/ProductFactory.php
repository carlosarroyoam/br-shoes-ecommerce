<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\ProductVariant;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $productName = $faker->sentence;
    return [
        'name' => $productName,
        'slug' => Str::slug($productName),
        'description' => $faker->paragraph,
        'featured' => false,
    ];
});

$factory->afterCreating(Product::class, function ($product, $faker) {
    $product->variants()->save(
        factory(ProductVariant::class)->states('is_master')->make()
    );
});

$factory->state(Product::class, 'featured', [
    'featured' => true,
]);
