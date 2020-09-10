<?php

namespace Database\Factories;

use App\Models\ProductVariant;
use App\Models\ShoppingBag;
use App\Models\ShoppingBagItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ShoppingBagItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShoppingBagItem::class;

    /**
        * Define the model's default state.
        *
        * @return array
        */
    public function definition()
    {
        return [
            'shopping_bag_id' => ShoppingBag::factory()->create(),
            'product_variant_id' => ProductVariant::factory()->create(),
            'quantity' => $this->faker->randomNumber(),
        ];
    }
}
