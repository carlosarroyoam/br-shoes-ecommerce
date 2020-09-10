<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\WishList;
use App\Models\WishListItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WishListItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WishListItem::class;

    /**
        * Define the model's default state.
        *
        * @return array
        */
    public function definition()
    {
        return [
            'wish_list_id' => WishList::factory()->create(),
            'product_id' => Product::factory()->create(),
        ];
    }
}
