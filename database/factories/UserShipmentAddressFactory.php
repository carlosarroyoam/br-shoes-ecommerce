<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserShipmentAddress;
use Faker\Generator as Faker;

$factory->define(UserShipmentAddress::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class),
        'address' => $faker->word,
        'city' => $faker->city,
        'state' => $faker->word,
        'zip_code' => $faker->randomNumber(),
        'country' => $faker->country,
    ];
});
