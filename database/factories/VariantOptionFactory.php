<?php

namespace Database\Factories;

use App\Models\VariantOption;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VariantOptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VariantOption::class;

    /**
        * Define the model's default state.
        *
        * @return array
        */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
