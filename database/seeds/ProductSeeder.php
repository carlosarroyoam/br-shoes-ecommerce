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
        factory(App\Product::class, 20)->create()->each(function ($product) {
            // $product->address()->save(factory(App\Address::class)->make());
        });
    }
}
