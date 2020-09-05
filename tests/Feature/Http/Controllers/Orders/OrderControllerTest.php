<?php

namespace Tests\Feature\Http\Controllers\Orders;

use App\Order;
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
        $user_id = $this->faker->randomNumber();
        $shipment_id = $this->faker->randomNumber();
        $order_status_id = $this->faker->randomDigitNotNull;

        $response = $this->post(route('orders.store'), [
            'user_id' => $user_id,
            'shipment_id' => $shipment_id,
            'order_status_id' => $order_status_id,
        ]);

        $orders = Order::query()
            ->where('user_id', $user_id)
            ->where('shipment_id', $shipment_id)
            ->where('order_status_id', $order_status_id)
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
        $user_id = $this->faker->randomNumber();
        $shipment_id = $this->faker->randomNumber();
        $order_status_id = $this->faker->randomDigitNotNull;

        $response = $this->put(route('orders.update', $order), [
            'user_id' => $user_id,
            'shipment_id' => $shipment_id,
            'order_status_id' => $order_status_id,
        ]);

        $order->refresh();

        $response->assertRedirect(route('orders.index'));
        $response->assertSessionHas('order.id', $order->id);

        $this->assertEquals($user_id, $order->user_id);
        $this->assertEquals($shipment_id, $order->shipment_id);
        $this->assertEquals($order_status_id, $order->order_status_id);
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
