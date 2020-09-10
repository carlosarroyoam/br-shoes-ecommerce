<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\WishList;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WishListFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WishList::class;

    /**
        * Define the model's default state.
        *
        * @return array
        */
    public function definition()
    {
        return [
            'user_id' => User::fatory()->create(),
        ];
    }
}
