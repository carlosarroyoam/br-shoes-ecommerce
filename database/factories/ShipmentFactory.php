<?php

namespace Database\Factories;

use App\Models\Shipment;
use App\Models\ShipmentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ShipmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shipment::class;

    /**
        * Define the model's default state.
        *
        * @return array
        */
    public function definition()
    {
        return [
            'shipment_status_id' => ShipmentStatus::factory()->create(),

        ];
    }
}
