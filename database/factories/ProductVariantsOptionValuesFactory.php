<?php

namespace Database\Factories;

use App\Models\ProductVariantsOptionValues;
use App\Models\ProductVariant;
use App\Models\VariantOptionValue;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductVariantsOptionValuesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductVariantsOptionValues::class;

    /**
        * Define the model's default state.
        *
        * @return array
        */
    public function definition()
    {
        return [
            'variant_option_value_id' => VariantOptionValue::factory()->create(),
            'product_variant_id' => ProductVariant::factory()->create(),
        ];
    }
}
