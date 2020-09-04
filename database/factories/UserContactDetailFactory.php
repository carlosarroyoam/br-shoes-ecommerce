<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserContactDetail;
use Faker\Generator as Faker;

$factory->define(UserContactDetail::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class),
        'phone_number' => $faker->phoneNumber,
    ];
});
