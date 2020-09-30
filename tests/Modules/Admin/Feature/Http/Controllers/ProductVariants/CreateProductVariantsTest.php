<?php

namespace Tests\Modules\Admin\Feature;

use App\Models\Admin;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use JMac\Testing\Traits\AdditionalAssertions;
use Symfony\Component\HttpFoundation\Response;
use Faker\Generator as Faker;
use Tests\TestCase;

class CreateProductVariantsTest extends TestCase
{
    use RefreshDatabase, AdditionalAssertions, WithFaker;


    /**
     * The route displays the view.
     *
     * @return void
     */
    public function test_create_displays_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin->user);

        $response = $this->get(route('admin.product-variants.create'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin::pages.products.variants.create');
    }


    /**
     * The store action in the controller uses form request validation.
     *
     * @return void
     */
    public function test_store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \Modules\Admin\Http\Controllers\Products\ProductVariantController::class,
            'store',
            \Modules\Admin\Http\Requests\Products\Variants\ProductVariantStoreRequest::class
        );
    }


    /**
     * Store action saves and redirects to index for an admin user.
     *
     * @return void
     */
    public function test_store_saves_and_redirects_for_admin_users()
    {
        $this->withoutExceptionHandling();
        $adminUser = Admin::factory()->create();
        $this->actingAs($adminUser->user);
        $product = Product::factory()->create();
        $price = $this->faker->numberBetween(1000, 999999);
        $expected = [
            'product_id' => $product->id,
            'price' => $price,
            'compared_at_price' => $price + 15000,
            'cost_per_item' => $price - 100,
            'quantity_on_stock' => $this->faker->numberBetween(1, 999),
        ];

        $response = $this->post(route('admin.product-variants.store'), [
            'product_id' => $expected['product_id'],
            'price' => $expected['price'],
            'compared_at_price' => $expected['compared_at_price'],
            'cost_per_item' => $expected['cost_per_item'],
            'quantity_on_stock' => $expected['quantity_on_stock'],
        ]);
        $productVariants = ProductVariant::query()
            ->where('product_id', $expected['product_id'])
            ->get();
        $productVariant = $productVariants->first();

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
     * Store action doesn't save for an authenticated non-admin user.
     *
     * @return void
     */
    public function test_store_doesnt_saves_for_non_admin_users()
    {
        $customerUser = Customer::factory()->create();
        $this->actingAs($customerUser->user);

        $response = $this->post(route('admin.product-variants.store'), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    /**
     * Store action doesn't save for an unauthenticated user.
     *
     * @return void
     */
    public function test_store_doesnt_saves_for_non_authenticated_users()
    {
        $response = $this->post(route('admin.product-variants.store'), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
