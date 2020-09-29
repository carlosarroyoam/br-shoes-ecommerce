<?php

namespace Tests\Modules\Admin\Feature;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\ProductProperty;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use JMac\Testing\Traits\AdditionalAssertions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateProductPropertiesTest extends TestCase
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
        $productProperty = ProductProperty::factory()->create();

        $response = $this->get(route('admin.product-properties.edit', $productProperty));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin::pages.products.properties.edit');
        $response->assertViewHas('productProperty', $productProperty);
    }


    /**
     * The update action in the controller uses form request validation.
     *
     * @return void
     */
    public function test_update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \Modules\Admin\Http\Controllers\Products\ProductPropertyController::class,
            'update',
            \Modules\Admin\Http\Requests\Products\Properties\ProductPropertyUpdateRequest::class
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
        $productProperty = ProductProperty::factory()->create();
        $expected = [
            'name' => $this->faker->name,
        ];

        $response = $this->put(route('admin.product-properties.update', $productProperty), [
            'name' => $expected['name']
        ]);
        $productProperty->fresh();

        $response->assertRedirect(route('admin.product-properties.index'));
        $response->assertSessionHas('productProperty.id', $productProperty->id);
        $this->assertDatabaseHas('product_properties', [
            'name' => $expected['name'],
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
        $productProperty = ProductProperty::factory()->create();

        $response = $this->put(route('admin.product-properties.update', $productProperty), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * Update action doesn't updates for an unauthenticated user.
     *
     * @return void
     */
    public function test_update_doesnt_updates_for_non_authenticated_users()
    {
        $productProperty = ProductProperty::factory()->create();

        $response = $this->put(route('admin.product-properties.update', $productProperty), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
