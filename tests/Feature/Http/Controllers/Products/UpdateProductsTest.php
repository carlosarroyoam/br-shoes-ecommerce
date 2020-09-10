<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use JMac\Testing\Traits\AdditionalAssertions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateProductsTest extends TestCase
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
        $product = Product::factory()->create();

        $response = $this->get(route('products.edit', $product));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.products.edit');
        $response->assertViewHas('product', $product);
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
            \App\Http\Controllers\Products\ProductController::class,
            'update',
            \App\Http\Requests\Products\ProductUpdateRequest::class
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
        $variant = ProductVariant::factory()->master()->create();
        $expected = [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'featured' => $this->faker->boolean,
        ];
        $expected['slug'] = Str::slug($expected['name']);

        $response = $this->put(route('products.update', $variant->product), [
            'name' => $expected['name'],
            'description' => $expected['description'],
            'featured' => $expected['featured'],
        ]);

        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('product.id', $variant->product->id);
        $this->assertDatabaseHas('products', [
            'name' => $expected['name'],
            'slug' => $expected['slug'],
            'description' => $expected['description'],
            'featured' => $expected['featured'],
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
        $variant = ProductVariant::factory()->master()->create();

        $response = $this->put(route('products.update', $variant->product), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * Update action doesn't updates for an unauthenticated user.
     *
     * @return void
     */
    public function test_update_doesnt_updates_for_non_authenticated_users()
    {
        $variant = ProductVariant::factory()->master()->create();

        $response = $this->put(route('products.update', $variant->product), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
