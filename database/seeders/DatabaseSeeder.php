<?php

namespace Database\Seeders;

use Database\Seeders\OrderStatusSeeder;
use Database\Seeders\ProductPropertySeeder;
use Database\Seeders\ShipmentStatusSeeder;
use Database\Seeders\SuperAdminSeeder;
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
            SuperAdminSeeder::class,
            ProductPropertySeeder::class,
            OrderStatusSeeder::class,
            ShipmentStatusSeeder::class,
        ]);
    }
}
