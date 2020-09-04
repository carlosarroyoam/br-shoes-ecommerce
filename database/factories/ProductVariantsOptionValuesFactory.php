<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductVariantsOptionValues;
use Faker\Generator as Faker;

$factory->define(ProductVariantsOptionValues::class, function (Faker $faker) {
    return [
        'variant_option_value_id' => factory(\App\VariantOptionValue::class),
        'product_variant_id' => factory(\App\ProductVariant::class),
    ];
});
