<?php

namespace Database\Factories;

use App\Models\VariantOptionValue;
use App\Models\ProductVariant;
use App\Models\VariantOption;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VariantOptionValueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VariantOptionValue::class;

    /**
        * Define the model's default state.
        *
        * @return array
        */
    public function definition()
    {
        return [
            'product_variant_id' => ProductVariant::factory()->create(),
            'variant_option_id' => VariantOption::factory()->create(),
            'value' => $this->faker->name,
        ];
    }
}
