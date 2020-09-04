<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class),
        'shipment_id' => factory(\App\Shipment::class),
        'order_status_id' => factory(\App\OrderStatus::class),
        'comments' => $faker->text,
    ];
});
