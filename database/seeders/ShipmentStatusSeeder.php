<?php

namespace Database\Seeders;

use App\Models\ShipmentStatus;
use Illuminate\Database\Seeder;

class ShipmentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShipmentStatus::factory()->create([
            'status' => 'Shipment not required',
            'description' => 'The order doesn\'t requires shipment'
        ]);

        ShipmentStatus::factory()->create([
            'status' => 'Shipment info received',
            'description' => 'The shipment info was received'
        ]);

        ShipmentStatus::factory()->create([
            'status' => 'Shipment prepared for recollection',
            'description' => 'The shipment was prepared and it\'s ready for recollection'
        ]);

        ShipmentStatus::factory()->create([
            'status' => 'Shipped',
            'description' => 'The shipment was sended'
        ]);

        ShipmentStatus::factory()->create([
            'status' => 'Delivered',
            'description' => 'The shipment was delivered to the customer'
        ]);
    }
}
