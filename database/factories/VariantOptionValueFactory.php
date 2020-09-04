<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\VariantOptionValue;
use Faker\Generator as Faker;

$factory->define(VariantOptionValue::class, function (Faker $faker) {
    return [
        'option_type_id' => factory(\App\VariantOptionType::class),
        'value' => $faker->word,
    ];
});
