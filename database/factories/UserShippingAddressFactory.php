<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserShippingAddress;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserShippingAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserShippingAddress::class;

    /**
        * Define the model's default state.
        *
        * @return array
        */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create(),
            'address' => $this->faker->word,
            'city' => $this->faker->city,
            'state' => $this->faker->word,
            'zip_code' => $this->faker->randomNumber(),
            'country' => $this->faker->country,
        ];
    }
}
