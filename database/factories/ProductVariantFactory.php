<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductVariantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductVariant::class;

    /**
        * Define the model's default state.
        *
        * @return array
        */
    public function definition()
    {
        $price = $this->faker->numberBetween(1000, 999999);

        return [
            'product_id' => Product::factory()->create(),
            'price' => $price,
            'compared_at_price' => $price + 15000,
            'cost_per_item' => $price - 100,
            'quantity_on_stock' => $this->faker->numberBetween(1, 999),
        ];
    }
}
