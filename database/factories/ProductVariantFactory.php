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
        return [
            'product_id' => Product::factory()->create(),
            'price_in_cents' => $this->faker->randomNumber(),
            'is_master' => $this->faker->boolean,
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
