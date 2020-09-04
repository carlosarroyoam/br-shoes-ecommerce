<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\WishListItem;
use Faker\Generator as Faker;

$factory->define(WishListItem::class, function (Faker $faker) {
    return [
        'wish_list_id' => factory(\App\WishList::class),
        'product_id' => factory(\App\Product::class),
    ];
});
