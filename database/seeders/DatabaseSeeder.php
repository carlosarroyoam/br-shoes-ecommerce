<?php

namespace Database\Seeders;

use Database\Seeders\ProductPropertySeeder;
use Database\Seeders\OrderStatusSeeder;
use Database\Seeders\ShipmentStatusSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProductPropertySeeder::class,
            OrderStatusSeeder::class,
            ShipmentStatusSeeder::class,
        ]);
    }
}
