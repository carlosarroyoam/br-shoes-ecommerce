<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\UserShippingAddress;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CustomerShippingAddressFactory extends Factory
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
            'customer_id' => Customer::factory()->create(),
            'address' => $this->faker->word,
            'city' => $this->faker->city,
            'state' => $this->faker->word,
            'zip_code' => $this->faker->randomNumber(5),
            'country' => $this->faker->country,
        ];
    }
}
