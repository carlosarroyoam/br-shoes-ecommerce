<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ShoppingBagItem;
use Faker\Generator as Faker;

$factory->define(ShoppingBagItem::class, function (Faker $faker) {
    return [
        'shopping_bag_id' => factory(\App\ShoppingBag::class),
        'product_variant_id' => factory(\App\ProductVariant::class),
        'quantity' => $faker->randomNumber(),
    ];
});
