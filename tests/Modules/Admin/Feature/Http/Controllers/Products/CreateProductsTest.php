<?php

namespace Tests\Modules\Admin\Feature;

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

        $response = $this->get(route('admin.products.create'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin::pages.products.create');
    }


    /**
     * The store action in the controller uses form request validation.
     *
     * @return void
     */
    public function test_store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \Modules\Admin\Http\Controllers\Products\ProductController::class,
            'store',
            \Modules\Admin\Http\Requests\Products\ProductStoreRequest::class
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
        $admin = Admin::factory()->create();
        $this->actingAs($admin->user);
        $expected = [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'featured' => $this->faker->boolean,
        ];
        $expected['slug'] = Str::slug($expected['name']);

        $response = $this->post(route('admin.products.store'), [
            'name' => $expected['name'],
            'description' => $expected['description'],
            'featured' => $expected['featured'],
        ]);
        $products = Product::query()
        ->where('name', $expected['name'])
        ->get();
        $product = $products->first();

        $response->assertRedirect(route('admin.products.index'));
        $response->assertSessionHas('product.id', $product->id);
        $this->assertDatabaseHas('products', [
            'name' => $expected['name'],
            'slug' => $expected['slug'],
            'description' => $expected['description'],
            'featured' => $expected['featured'],
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

        $response = $this->post(route('admin.products.store'), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    /**
     * Store action doesn't save for an unauthenticated user.
     *
     * @return void
     */
    public function test_store_doesnt_saves_for_non_authenticated_users()
    {
        $response = $this->post(route('admin.products.store'), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
