<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\VariantOptionType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VariantOptionTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VariantOptionType::class;

    /**
        * Define the model's default state.
        *
        * @return array
        */
    public function definition()
    {
        return [
            'product_id' => Product::factory()->create(),
            'name' => $this->faker->name,
        ];
    }
}
