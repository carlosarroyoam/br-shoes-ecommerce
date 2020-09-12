<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\ProductPropertyType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use JMac\Testing\Traits\AdditionalAssertions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateProductPropertyTypesTest extends TestCase
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
        $productPropertyType = ProductPropertyType::factory()->create();

        $response = $this->get(route('product-property-types.edit', $productPropertyType));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.products.property-types.edit');
        $response->assertViewHas('productPropertyType', $productPropertyType);
    }


    /**
     * The update action in the controller uses form request validation.
     *
     * @return void
     */
    public function test_update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Products\ProductPropertyTypeController::class,
            'update',
            \App\Http\Requests\Products\PropertyTypes\ProductPropertyTypeUpdateRequest::class
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
        $productPropertyType = ProductPropertyType::factory()->create();
        $expected = [
            'name' => $this->faker->name,
        ];

        $response = $this->put(route('product-property-types.update', $productPropertyType), [
            'name' => $expected['name']
        ]);
        $productPropertyType->fresh();

        $response->assertRedirect(route('product-property-types.index'));
        $response->assertSessionHas('productPropertyType.id', $productPropertyType->id);
        $this->assertDatabaseHas('product_property_types', [
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
        $productPropertyType = ProductPropertyType::factory()->create();

        $response = $this->put(route('product-property-types.update', $productPropertyType), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * Update action doesn't updates for an unauthenticated user.
     *
     * @return void
     */
    public function test_update_doesnt_updates_for_non_authenticated_users()
    {
        $productPropertyType = ProductPropertyType::factory()->create();

        $response = $this->put(route('product-property-types.update', $productPropertyType), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
