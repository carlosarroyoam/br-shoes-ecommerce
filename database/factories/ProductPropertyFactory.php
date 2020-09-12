<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductProperty;
use App\Models\ProductPropertyType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductPropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductProperty::class;

    /**
        * Define the model's default state.
        *
        * @return array
        */
    public function definition()
    {
        return [
            'product_id' => Product::factory()->create(),
            'product_property_type_id' => ProductPropertyType::factory()->create(),
            'value' => $this->faker->word,
        ];
    }
}
