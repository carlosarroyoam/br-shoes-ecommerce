<?php

namespace Tests\Feature\Http\Controllers\Orders;

use App\Order;
use App\OrderDetail;
use App\ProductVariant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Orders\OrderDetailController
 */
class OrderDetailControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $orderDetails = factory(OrderDetail::class, 3)->create();

        $response = $this->get(route('order-details.index'));

        $response->assertOk();
        $response->assertViewIs('pages.orders.order-details.index');
        $response->assertViewHas('orderDetails');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('order-details.create'));

        $response->assertOk();
        $response->assertViewIs('pages.orders.order-details.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Orders\OrderDetailController::class,
            'store',
            \App\Http\Requests\Orders\OrderDetails\OrderDetailStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $this->withoutExceptionHandling();

        $order = factory(Order::class)->create();
        $product_variant = factory(ProductVariant::class)->create();
        $quantity = 10;

        $response = $this->post(route('order-details.store'), [
            'order_id' => $order->id,
            'product_variant_id' => $product_variant->id,
            'quantity' => $quantity,
        ]);

        $orderDetails = OrderDetail::query()
            ->where('order_id', $order->id)
            ->where('product_variant_id', $product_variant->id)
            ->where('quantity', $quantity)
            ->get();
        $orderDetail = $orderDetails->first();

        $response->assertRedirect(route('order-details.index'));
        $response->assertSessionHas('orderDetail.id', $orderDetail->id);
        $this->assertDatabaseHas('order_details', [
            'order_id' => $order->id,
        ]);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $orderDetail = factory(OrderDetail::class)->create();

        $response = $this->get(route('order-details.show', $orderDetail));

        $response->assertOk();
        $response->assertViewIs('pages.orders.order-details.show');
        $response->assertViewHas('orderDetail');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $orderDetail = factory(OrderDetail::class)->create();

        $response = $this->get(route('order-details.edit', $orderDetail));

        $response->assertOk();
        $response->assertViewIs('pages.orders.order-details.edit');
        $response->assertViewHas('orderDetail');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Orders\OrderDetailController::class,
            'update',
            \App\Http\Requests\Orders\OrderDetails\OrderDetailUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $this->withoutExceptionHandling();

        $orderDetail = factory(OrderDetail::class)->create();
        $order = Order::first();
        $product_variant = factory(ProductVariant::class)->create();
        $quantity = 10;

        $response = $this->put(route('order-details.update', $orderDetail), [
            'product_variant_id' => $product_variant->id,
            'quantity' => $quantity,
        ]);

        $orderDetail->refresh();

        $response->assertRedirect(route('order-details.index'));
        $response->assertSessionHas('orderDetail.id', $orderDetail->id);

        $this->assertEquals($order->id, $orderDetail->order_id);
        $this->assertEquals($product_variant->id, $orderDetail->product_variant_id);
        $this->assertEquals($quantity, $orderDetail->quantity);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $orderDetail = factory(OrderDetail::class)->create();

        $response = $this->delete(route('order-details.destroy', $orderDetail));

        $response->assertRedirect(route('order-details.index'));

        $this->assertDeleted($orderDetail);
    }
}
