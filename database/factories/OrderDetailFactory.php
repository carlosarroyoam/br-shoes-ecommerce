<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrderDetail;
use Faker\Generator as Faker;

$factory->define(OrderDetail::class, function (Faker $faker) {
    return [
        'order_id' => factory(\App\Order::class),
        'product_variant_id' => factory(\App\ProductVariant::class),
        'quantity' => $faker->randomNumber(),
    ];
});
