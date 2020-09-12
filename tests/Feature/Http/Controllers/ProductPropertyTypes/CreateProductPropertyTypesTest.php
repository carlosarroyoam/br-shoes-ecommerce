<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\ProductPropertyType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateProductPropertyTypesTest extends TestCase
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

        $response = $this->get(route('product-property-types.create'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.products.property-types.create');
    }


    /**
     * The store action in the controller uses form request validation.
     *
     * @return void
     */
    public function test_store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Products\ProductPropertyTypeController::class,
            'store',
            \App\Http\Requests\Products\PropertyTypes\ProductPropertyTypeStoreRequest::class
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
        $expected = [
            'name' => $this->faker->name,
        ];

        $response = $this->post(route('product-property-types.store'), [
            'name' => $expected['name']
        ]);
        $productPropertyTypes = ProductPropertyType::query()
            ->where('name', $expected['name'])
            ->get();
        $productPropertyType = $productPropertyTypes->first();

        $response->assertRedirect(route('product-property-types.index'));
        $response->assertSessionHas('productPropertyType.id', $productPropertyType->id);
        $this->assertDatabaseHas('product_property_types', [
            'name' => $expected['name'],
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

        $response = $this->post(route('product-property-types.store'), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    /**
     * Store action doesn't save for an unauthenticated user.
     *
     * @return void
     */
    public function test_store_doesnt_saves_for_non_authenticated_users()
    {
        $response = $this->post(route('product-property-types.store'), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
