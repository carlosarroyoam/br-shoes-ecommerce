<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 5)->create()->each(function ($user) {
            $user->address()->save(factory(App\Address::class)->make());
            $user->contactDetail()->save(factory(App\ContactDetail::class)->make());
        });
    }
}