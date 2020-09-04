<?php

namespace Tests\Feature\Http\Controllers\Shipments;

use App\Shipment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Shipments\ShipmentController
 */
class ShipmentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $shipments = factory(Shipment::class, 3)->create();

        $response = $this->get(route('shipment.index'));

        $response->assertOk();
        $response->assertViewIs('shipment.index');
        $response->assertViewHas('shipments');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('shipment.create'));

        $response->assertOk();
        $response->assertViewIs('shipment.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Shipments\ShipmentController::class,
            'store',
            \App\Http\Requests\Shipments\ShipmentStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $shipment_status_id = $this->faker->randomDigitNotNull;

        $response = $this->post(route('shipment.store'), [
            'shipment_status_id' => $shipment_status_id,
        ]);

        $shipments = Shipment::query()
            ->where('shipment_status_id', $shipment_status_id)
            ->get();
        $this->assertCount(1, $shipments);
        $shipment = $shipments->first();

        $response->assertRedirect(route('shipment.index'));
        $response->assertSessionHas('shipment.id', $shipment->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $shipment = factory(Shipment::class)->create();

        $response = $this->get(route('shipment.show', $shipment));

        $response->assertOk();
        $response->assertViewIs('shipment.show');
        $response->assertViewHas('shipment');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $shipment = factory(Shipment::class)->create();

        $response = $this->get(route('shipment.edit', $shipment));

        $response->assertOk();
        $response->assertViewIs('shipment.edit');
        $response->assertViewHas('shipment');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Shipments\ShipmentController::class,
            'update',
            \App\Http\Requests\Shipments\ShipmentUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $shipment = factory(Shipment::class)->create();
        $shipment_status_id = $this->faker->randomDigitNotNull;

        $response = $this->put(route('shipment.update', $shipment), [
            'shipment_status_id' => $shipment_status_id,
        ]);

        $shipment->refresh();

        $response->assertRedirect(route('shipment.index'));
        $response->assertSessionHas('shipment.id', $shipment->id);

        $this->assertEquals($shipment_status_id, $shipment->shipment_status_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $shipment = factory(Shipment::class)->create();

        $response = $this->delete(route('shipment.destroy', $shipment));

        $response->assertRedirect(route('shipment.index'));

        $this->assertDeleted($shipment);
    }
}
