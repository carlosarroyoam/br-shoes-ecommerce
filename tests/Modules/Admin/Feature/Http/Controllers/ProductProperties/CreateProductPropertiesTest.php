<?php

namespace Tests\Modules\Admin\Feature;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\ProductProperty;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateProductPropertiesTest extends TestCase
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

        $response = $this->get(route('admin.product-properties.create'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin::pages.products.properties.create');
    }


    /**
     * The store action in the controller uses form request validation.
     *
     * @return void
     */
    public function test_store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \Modules\Admin\Http\Controllers\Products\ProductPropertyController::class,
            'store',
            \Modules\Admin\Http\Requests\Products\Properties\ProductPropertyStoreRequest::class
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

        $response = $this->post(route('admin.product-properties.store'), [
            'name' => $expected['name']
        ]);
        $productProperties = ProductProperty::query()
            ->where('name', $expected['name'])
            ->get();
        $productProperty = $productProperties->first();

        $response->assertRedirect(route('admin.product-properties.index'));
        $response->assertSessionHas('productProperty.id', $productProperty->id);
        $this->assertDatabaseHas('product_properties', [
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

        $response = $this->post(route('admin.product-properties.store'), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    /**
     * Store action doesn't save for an unauthenticated user.
     *
     * @return void
     */
    public function test_store_doesnt_saves_for_non_authenticated_users()
    {
        $response = $this->post(route('admin.product-properties.store'), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
