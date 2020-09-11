<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductProperty;
use App\Models\ProductPropertyType;
use App\Models\User;
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
        $this->withoutExceptionHandling();

        $user = User::factory()->admin('is_admin')->make();
        $this->actingAs($user);

        $response = $this->get(route('product-properties.create'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.products.properties.create');
    }


    /**
     * The store action in the controller uses form request validation.
     *
     * @return void
     */
    public function test_store_uses_form_request_validation()
    {
        $this->withoutExceptionHandling();

        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Products\ProductPropertyController::class,
            'store',
            \App\Http\Requests\Products\Properties\ProductPropertyStoreRequest::class
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

        $user = User::factory()->admin('is_admin')->make();
        $this->actingAs($user);
        $product = Product::factory()->create();
        $property_type = ProductPropertyType::factory()->create();
        $expected = [
            'product_id' => $product->id,
            'property_type_id' => $property_type->id,
            'value' => $this->faker->name,
        ];

        $response = $this->post(route('product-properties.store'), [
            'product_id' => $expected['product_id'],
            'property_type_id' => $expected['property_type_id'],
            'value' => $expected['value']
        ]);
        $productProperties = ProductProperty::query()
            ->where('value', $expected['value'])
            ->get();
        $productProperty = $productProperties->first();

        $response->assertRedirect(route('product-properties.index'));
        $response->assertSessionHas('productProperty.id', $productProperty->id);
        $this->assertDatabaseHas('product_properties', [
            'product_id' => $expected['product_id'],
            'property_type_id' => $expected['property_type_id'],
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
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('product-properties.store'), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    /**
     * Store action doesn't save for an unauthenticated user.
     *
     * @return void
     */
    public function test_store_doesnt_saves_for_non_authenticated_users()
    {
        $response = $this->post(route('product-properties.store'), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
