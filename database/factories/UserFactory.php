<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$RuQR6w7eZ46cGvY8lvTOtOUjxHQtOmYmmDO7NqaFTgeDNK5RkjtD.', // secret
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the user is morph to an admin.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function admin($typeable_id)
    {
        return $this->state([
            'userable_id' => $typeable_id,
            'userable_type' => 'App\Models\Admin',
        ]);
    }

    /**
     * Indicate that the user is morph to a customer.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function customer($typeable_id)
    {
        return $this->state([
            'userable_id' => $typeable_id,
            'userable_type' => 'App\Models\Customer',
        ]);
    }
}
