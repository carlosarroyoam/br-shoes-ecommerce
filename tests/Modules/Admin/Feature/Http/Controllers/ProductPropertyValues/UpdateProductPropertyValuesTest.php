<?php

namespace Tests\Modules\Admin\Feature;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\ProductPropertyValue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use JMac\Testing\Traits\AdditionalAssertions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateProductPropertyValuesTest extends TestCase
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
        $productPropertyValue = ProductPropertyValue::factory()->create();

        $response = $this->get(route('admin.product-property-values.edit', $productPropertyValue));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin::pages.products.property-values.edit');
        $response->assertViewHas('productPropertyValue', $productPropertyValue);
    }


    /**
     * The update action in the controller uses form request validation.
     *
     * @return void
     */
    public function test_update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \Modules\Admin\Http\Controllers\Products\ProductPropertyValueController::class,
            'update',
            \Modules\Admin\Http\Requests\Products\PropertyValues\ProductPropertyValueUpdateRequest::class
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
        $productPropertyValue = ProductPropertyValue::factory()->create();
        $expected = [
            'value' => $this->faker->name,
        ];

        $response = $this->put(route('admin.product-property-values.update', $productPropertyValue), [
            'value' => $expected['value']
        ]);
        $productPropertyValue->fresh();


        $response->assertRedirect(route('admin.product-property-values.index'));
        $response->assertSessionHas('productPropertyValue.id', $productPropertyValue->id);
        $this->assertDatabaseHas('product_property_values', [
            'value' => $expected['value'],
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
        $productProperty = ProductPropertyValue::factory()->create();

        $response = $this->put(route('admin.product-property-values.update', $productProperty), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * Update action doesn't updates for an unauthenticated user.
     *
     * @return void
     */
    public function test_update_doesnt_updates_for_non_authenticated_users()
    {
        $productProperty = ProductPropertyValue::factory()->create();

        $response = $this->put(route('admin.product-property-values.update', $productProperty), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
