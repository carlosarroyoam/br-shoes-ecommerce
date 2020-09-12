<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Admin $admin) {
            User::factory()->admin($admin->id)->make();
        })->afterCreating(function (Admin $admin) {
            User::factory()->admin($admin->id)->create();
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'is_super' => false,
        ];
    }

    /**
     * Indicate that the user is an admin-user.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function super()
    {
        return $this->state([
            'is_super' => true,
        ]);
    }
}
