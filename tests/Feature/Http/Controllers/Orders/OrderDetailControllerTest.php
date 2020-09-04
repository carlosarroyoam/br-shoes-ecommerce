<?php

namespace Tests\Feature\Http\Controllers\Orders;

use App\OrderDetail;
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

        $response = $this->get(route('order-detail.index'));

        $response->assertOk();
        $response->assertViewIs('orderDetail.index');
        $response->assertViewHas('orderDetails');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('order-detail.create'));

        $response->assertOk();
        $response->assertViewIs('orderDetail.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Orders\OrderDetailController::class,
            'store',
            \App\Http\Requests\Orders\OrderDetailStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $order_id = $this->faker->randomNumber();
        $product_variant_id = $this->faker->randomNumber();
        $quantity = $this->faker->randomNumber();

        $response = $this->post(route('order-detail.store'), [
            'order_id' => $order_id,
            'product_variant_id' => $product_variant_id,
            'quantity' => $quantity,
        ]);

        $orderDetails = OrderDetail::query()
            ->where('order_id', $order_id)
            ->where('product_variant_id', $product_variant_id)
            ->where('quantity', $quantity)
            ->get();
        $this->assertCount(1, $orderDetails);
        $orderDetail = $orderDetails->first();

        $response->assertRedirect(route('orderDetail.index'));
        $response->assertSessionHas('orderDetail.id', $orderDetail->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $orderDetail = factory(OrderDetail::class)->create();

        $response = $this->get(route('order-detail.show', $orderDetail));

        $response->assertOk();
        $response->assertViewIs('orderDetail.show');
        $response->assertViewHas('orderDetail');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $orderDetail = factory(OrderDetail::class)->create();

        $response = $this->get(route('order-detail.edit', $orderDetail));

        $response->assertOk();
        $response->assertViewIs('orderDetail.edit');
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
            \App\Http\Requests\Orders\OrderDetailUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $orderDetail = factory(OrderDetail::class)->create();
        $order_id = $this->faker->randomNumber();
        $product_variant_id = $this->faker->randomNumber();
        $quantity = $this->faker->randomNumber();

        $response = $this->put(route('order-detail.update', $orderDetail), [
            'order_id' => $order_id,
            'product_variant_id' => $product_variant_id,
            'quantity' => $quantity,
        ]);

        $orderDetail->refresh();

        $response->assertRedirect(route('orderDetail.index'));
        $response->assertSessionHas('orderDetail.id', $orderDetail->id);

        $this->assertEquals($order_id, $orderDetail->order_id);
        $this->assertEquals($product_variant_id, $orderDetail->product_variant_id);
        $this->assertEquals($quantity, $orderDetail->quantity);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $orderDetail = factory(OrderDetail::class)->create();

        $response = $this->delete(route('order-detail.destroy', $orderDetail));

        $response->assertRedirect(route('orderDetail.index'));

        $this->assertDeleted($orderDetail);
    }
}
