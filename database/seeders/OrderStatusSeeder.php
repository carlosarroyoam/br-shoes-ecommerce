<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderStatus::factory()->create([
            'status' => 'Pending',
            'description' => 'El pedido aun no ha sido despachado de nuestras bodegas'
        ]);

        OrderStatus::factory()->create([
            'status' => 'Processing',
            'description' => 'El pedido esta siendo surtido'
        ]);

        OrderStatus::factory()->create([
            'status' => 'Completed',
            'description' => 'El pedido se surtio y esta listo para su envio o entrega'
        ]);

        OrderStatus::factory()->create([
            'status' => 'Cancelled',
            'description' => 'El pedido fue cancelado por el cliente o nuestros agentes'
        ]);
    }
}
