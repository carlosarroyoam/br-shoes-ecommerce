<?php

namespace Tests\Feature\Http\Controllers\Shipments;

use App\Shipment;
use App\ShipmentStatus;
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

        $response = $this->get(route('shipments.index'));

        $response->assertOk();
        $response->assertViewIs('pages.shipments.index');
        $response->assertViewHas('shipments');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('shipments.create'));

        $response->assertOk();
        $response->assertViewIs('pages.shipments.create');
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
        $shipmentStatus = factory(ShipmentStatus::class)->create();

        $response = $this->post(route('shipments.store'), [
            'shipment_status_id' => $shipmentStatus->id,
        ]);

        $shipments = Shipment::query()
            ->where('shipment_status_id', $shipmentStatus->id)
            ->get();
        $this->assertCount(1, $shipments);
        $shipment = $shipments->first();

        $response->assertRedirect(route('shipments.index'));
        $response->assertSessionHas('shipment.id', $shipment->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $shipment = factory(Shipment::class)->create();

        $response = $this->get(route('shipments.show', $shipment));

        $response->assertOk();
        $response->assertViewIs('pages.shipments.show');
        $response->assertViewHas('shipment');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $shipment = factory(Shipment::class)->create();

        $response = $this->get(route('shipments.edit', $shipment));

        $response->assertOk();
        $response->assertViewIs('pages.shipments.edit');
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
        $newShipmentStatus = factory(ShipmentStatus::class)->create();
        $shipment = factory(Shipment::class)->create();

        $response = $this->put(route('shipments.update', $shipment), [
            'shipment_status_id' => $newShipmentStatus->id,
        ]);

        $shipment->refresh();

        $response->assertRedirect(route('shipments.index'));
        $response->assertSessionHas('shipment.id', $shipment->id);

        $this->assertEquals($newShipmentStatus->id, $shipment->shipment_status_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $shipment = factory(Shipment::class)->create();

        $response = $this->delete(route('shipments.destroy', $shipment));

        $response->assertRedirect(route('shipments.index'));

        $this->assertDeleted($shipment);
    }
}
