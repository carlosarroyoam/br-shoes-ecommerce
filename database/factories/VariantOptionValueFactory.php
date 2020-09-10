<?php

namespace Database\Factories;

use App\Models\VariantOptionType;
use App\Models\VariantOptionValue;
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
            'option_type_id' => VariantOptionType::factory()->create(),
            'value' => $this->faker->word,
        ];
    }
}
