<?php

namespace Tests\Modules\Admin\Feature;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\ProductVariant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use JMac\Testing\Traits\AdditionalAssertions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateProductVariantsTest extends TestCase
{
    use RefreshDatabase, AdditionalAssertions, WithFaker;

    /**
     * The route displays the view.
     *
     * @return void
     */
    public function test_edit_displays_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin->user);
        $productVariant = ProductVariant::factory()->create();

        $response = $this->get(route('admin.product-variants.edit', $productVariant));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin::pages.products.variants.edit');
        $response->assertViewHas('productVariant', $productVariant);
    }


    /**
     * The update action in the controller uses form request validation.
     *
     * @return void
     */
    public function test_update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \Modules\Admin\Http\Controllers\Products\ProductVariantController::class,
            'update',
            \Modules\Admin\Http\Requests\Products\Variants\ProductVariantUpdateRequest::class
        );
    }


    /**
     * Update action updates and redirects to index for an admin user.
     *
     * @return void
     */
    public function test_update_updates_and_redirects_for_admin_users()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin->user);
        $productVariant = ProductVariant::factory()->create();
        $price = $this->faker->numberBetween(1000, 999999);
        $expected = [
            'product_id' => $productVariant->product->id,
            'price' => $price,
            'compared_at_price' => $price + 15000,
            'cost_per_item' => $price - 100,
            'quantity_on_stock' => $this->faker->numberBetween(1, 999),
        ];

        $response = $this->put(route('admin.product-variants.update', $productVariant), [
            'product_id' => $expected['product_id'],
            'price' => $expected['price'],
            'compared_at_price' => $expected['compared_at_price'],
            'cost_per_item' => $expected['cost_per_item'],
            'quantity_on_stock' => $expected['quantity_on_stock'],
        ]);
        $productVariant->fresh();

        $response->assertRedirect(route('admin.product-variants.index'));
        $response->assertSessionHas('productVariant.id', $productVariant->id);
        $this->assertDatabaseHas('product_variants', [
            'product_id' => $expected['product_id'],
            'price' => $expected['price'],
            'compared_at_price' => $expected['compared_at_price'],
            'cost_per_item' => $expected['cost_per_item'],
            'quantity_on_stock' => $expected['quantity_on_stock'],
        ]);
    }

    /**
     * Update action doesn't updates for an authenticated non-admin user.
     *
     * @return void
     */
    public function test_udpate_doesnt_updates_for_non_admin_users()
    {
        $customerUser = Customer::factory()->create();
        $this->actingAs($customerUser->user);
        $productVariant = ProductVariant::factory()->create();

        $response = $this->put(route('admin.product-variants.update', $productVariant), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * Update action doesn't updates for an unauthenticated user.
     *
     * @return void
     */
    public function test_update_doesnt_updates_for_non_authenticated_users()
    {
        $productVariant = ProductVariant::factory()->create();

        $response = $this->put(route('admin.product-variants.update', $productVariant), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
