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
        $price = $this->faker->randomNumber();
        return [
            'product_id' => Product::factory()->create(),
            'is_master' => $this->faker->boolean,
            'price' => $price,
            'compare_at_price' => $price + 15000,
            'cost_per_item' => $this->faker->randomNumber(),
            'quantity_on_stock' => $this->faker->randomNumber(),
        ];
    }

    /**
     * Indicate that the user is an admin-user.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function master()
    {
        return $this->state([
            'is_master' => true,
        ]);
    }
}
