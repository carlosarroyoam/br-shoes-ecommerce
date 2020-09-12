<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use JMac\Testing\Traits\AdditionalAssertions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateProductsTest extends TestCase
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

        $response = $this->get(route('products.create'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.products.create');
    }


    /**
     * The store action in the controller uses form request validation.
     *
     * @return void
     */
    public function test_store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Products\ProductController::class,
            'store',
            \App\Http\Requests\Products\ProductStoreRequest::class
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
            'description' => $this->faker->text,
            'featured' => $this->faker->boolean,
            'variants.price_in_cents' => $this->faker->randomNumber(5),
            'variants.is_master' => true,
        ];
        $expected['slug'] = Str::slug($expected['name']);

        $response = $this->post(route('products.store'), [
            'name' => $expected['name'],
            'description' => $expected['description'],
            'featured' => $expected['featured'],
            'price_in_cents' => $expected['variants.price_in_cents'],
        ]);
        $products = Product::query()
        ->where('name', $expected['name'])
        ->get();
        $product = $products->first();

        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('product.id', $product->id);
        $this->assertDatabaseHas('products', [
            'name' => $expected['name'],
            'slug' => $expected['slug'],
            'description' => $expected['description'],
            'featured' => $expected['featured'],
        ]);
        $this->assertDatabaseHas('product_variants', [
            'product_id' => Product::first()->id,
            'price_in_cents' => $expected['variants.price_in_cents'],
            'is_master' => $expected['variants.is_master'],
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

        $response = $this->post(route('products.store'), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    /**
     * Store action doesn't save for an unauthenticated user.
     *
     * @return void
     */
    public function test_store_doesnt_saves_for_non_authenticated_users()
    {
        $response = $this->post(route('products.store'), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
