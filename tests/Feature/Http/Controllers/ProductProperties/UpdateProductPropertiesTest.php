<?php

namespace Tests\Feature;

use App\Models\ProductProperty;
use App\Models\User;
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
        $this->withoutExceptionHandling();

        $user = User::factory()->admin()->make();
        $this->actingAs($user);
        $productProperty = ProductProperty::factory()->create();

        $response = $this->get(route('product-properties.edit', $productProperty));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.products.properties.edit');
        $response->assertViewHas('productProperty', $productProperty);
    }


    /**
     * The update action in the controller uses form request validation.
     *
     * @return void
     */
    public function test_update_uses_form_request_validation()
    {
        $this->withoutExceptionHandling();

        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Products\ProductPropertyController::class,
            'update',
            \App\Http\Requests\Products\Properties\ProductPropertyUpdateRequest::class
        );
    }


    /**
     * Update action updates and redirects to index for an admin user.
     *
     * @return void
     */
    public function test_update_updates_and_redirects_for_admin_users()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->admin()->make();
        $this->actingAs($user);
        $productProperty = ProductProperty::factory()->create();
        $expected = [
            'value' => $this->faker->name,
        ];

        $response = $this->put(route('product-properties.update', $productProperty), [
            'value' => $expected['value']
        ]);
        $productProperty->fresh();


        $response->assertRedirect(route('product-properties.index'));
        $response->assertSessionHas('productProperty.id', $productProperty->id);
        $this->assertDatabaseHas('product_properties', [
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
        $user = User::factory()->make();
        $this->actingAs($user);
        $productProperty = ProductProperty::factory()->create();

        $response = $this->put(route('product-properties.update', $productProperty), []);

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

        $response = $this->put(route('product-properties.update', $productProperty), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
