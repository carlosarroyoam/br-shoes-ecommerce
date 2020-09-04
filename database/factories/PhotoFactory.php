<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Photo;
use Faker\Generator as Faker;

$factory->define(Photo::class, function (Faker $faker) {
    return [
        'url' => $faker->url,
        'photoable_id' => $faker->randomNumber(),
        'photoable_type' => $faker->word,
    ];
});
