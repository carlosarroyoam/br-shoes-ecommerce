<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserContactDetail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserContactDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    protected $model = UserContactDetail::class;

    /**
        * Define the model's default state.
        *
        * @return array
        */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create(),
            'phone_number' => $this->faker->phoneNumber,
        ];
    }
}
