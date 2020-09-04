<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shipment;
use Faker\Generator as Faker;

$factory->define(Shipment::class, function (Faker $faker) {
    return [
        'shipment_status_id' => factory(\App\ShipmentStatus::class),
    ];
});
