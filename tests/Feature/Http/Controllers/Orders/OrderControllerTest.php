<?php

namespace Tests\Feature\Http\Controllers\Orders;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Orders\OrderController
 */
class OrderControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $orders = factory(Order::class, 3)->create();

        $response = $this->get(route('orders.index'));

        $response->assertOk();
        $response->assertViewIs('pages.orders.index');
        $response->assertViewHas('orders');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('orders.create'));

        $response->assertOk();
        $response->assertViewIs('pages.orders.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Orders\OrderController::class,
            'store',
            \App\Http\Requests\Orders\OrderStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = factory(User::class)->create();
        $shipment = factory(Shipment::class)->create();
        $order_status = factory(OrderStatus::class)->create();

        $response = $this->post(route('orders.store'), [
            'user_id' => $user->id,
            'shipment_id' => $shipment->id,
            'order_status_id' => $order_status->id,
        ]);

        $orders = Order::query()
            ->where('user_id', $user->id)
            ->where('shipment_id', $shipment->id)
            ->where('order_status_id', $order_status->id)
            ->get();
        $this->assertCount(1, $orders);
        $order = $orders->first();

        $response->assertRedirect(route('orders.index'));
        $response->assertSessionHas('order.id', $order->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $order = factory(Order::class)->create();

        $response = $this->get(route('orders.show', $order));

        $response->assertOk();
        $response->assertViewIs('pages.orders.show');
        $response->assertViewHas('order');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $order = factory(Order::class)->create();

        $response = $this->get(route('orders.edit', $order));

        $response->assertOk();
        $response->assertViewIs('pages.orders.edit');
        $response->assertViewHas('order');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Orders\OrderController::class,
            'update',
            \App\Http\Requests\Orders\OrderUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $order = factory(Order::class)->create();
        $user = User::first();
        $shipment = Shipment::first();
        $order_status = OrderStatus::first();

        $response = $this->put(route('orders.update', $order), [
            'user_id' => $user->id,
            'shipment_id' => $shipment->id,
            'order_status_id' => $order_status->id,
        ]);

        $order->refresh();

        $response->assertRedirect(route('orders.index'));
        $response->assertSessionHas('order.id', $order->id);

        $this->assertEquals($user->id, $order->user_id);
        $this->assertEquals($shipment->id, $order->shipment_id);
        $this->assertEquals($order_status->id, $order->order_status_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $order = factory(Order::class)->create();

        $response = $this->delete(route('orders.destroy', $order));

        $response->assertRedirect(route('orders.index'));

        $this->assertDeleted($order);
    }
}
