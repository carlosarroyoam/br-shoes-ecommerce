<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductProperty;
use App\Models\ProductPropertyValue;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductPropertyValueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductPropertyValue::class;

    /**
        * Define the model's default state.
        *
        * @return array
        */
    public function definition()
    {
        return [
            'product_id' => Product::factory()->create(),
            'product_property_id' => ProductProperty::factory()->create(),
            'value' => $this->faker->name,
        ];
    }
}
