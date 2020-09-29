<?php

namespace Tests\Modules\Admin\Feature;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductProperty;
use App\Models\ProductPropertyValue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateProductPropertyValuesTest extends TestCase
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

        $response = $this->get(route('admin.product-property-values.create'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin::pages.products.property-values.create');
    }


    /**
     * The store action in the controller uses form request validation.
     *
     * @return void
     */
    public function test_store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \Modules\Admin\Http\Controllers\Products\ProductPropertyValueController::class,
            'store',
            \Modules\Admin\Http\Requests\Products\PropertyValues\ProductPropertyValueStoreRequest::class
        );
    }


    /**
     * Store action saves and redirects to index for an admin user.
     *
     * @return void
     */
    public function test_store_saves_and_redirects_for_admin_users()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin->user);
        $product = Product::factory()->create();
        $productProperty = ProductProperty::factory()->create();
        $expected = [
            'product_id' => $product->id,
            'product_property_id' => $productProperty->id,
            'value' => $this->faker->name,
        ];

        $response = $this->post(route('admin.product-property-values.store'), [
            'product_id' => $expected['product_id'],
            'product_property_id' => $expected['product_property_id'],
            'value' => $expected['value']
        ]);
        $productPropertiesValues = ProductPropertyValue::query()
            ->where('value', $expected['value'])
            ->get();
        $productPropertyValue = $productPropertiesValues->first();

        $response->assertRedirect(route('admin.product-property-values.index'));
        $response->assertSessionHas('productPropertyValue.id', $productPropertyValue->id);
        $this->assertDatabaseHas('product_property_values', [
            'product_id' => $expected['product_id'],
            'product_property_id' => $expected['product_property_id'],
            'value' => $expected['value'],
        ]);
    }


    /**
     * Store action doesn't save for an authenticated non-admin user.
     *
     * @return void
     */
    public function test_store_doesnt_saves_for_non_admin_users()
    {
        $customer = Customer::factory()->create();
        $this->actingAs($customer->user);

        $response = $this->post(route('admin.product-property-values.store'), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    /**
     * Store action doesn't save for an unauthenticated user.
     *
     * @return void
     */
    public function test_store_doesnt_saves_for_non_authenticated_users()
    {
        $response = $this->post(route('admin.product-property-values.store'), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
