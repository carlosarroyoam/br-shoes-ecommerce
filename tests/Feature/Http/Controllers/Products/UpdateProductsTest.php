<?php

namespace Tests\Feature;

use App\Product;
use App\ProductVariant;
use App\User;
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

        $user = factory(User::class)->states('is_admin')->create();
        $this->actingAs($user);
        $product = factory(Product::class)->create();

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

        $user = factory(User::class)->states('is_admin')->make();
        $this->actingAs($user);
        $variant = factory(ProductVariant::class)->states('is_master')->create();
        $expected = [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'featured' => $this->faker->boolean,
            'variants.price_in_cents' => $this->faker->randomNumber(5),
            'variants.is_master' => true,
        ];
        $expected['slug'] = Str::slug($expected['name']);

        $response = $this->put(route('products.update', Product::first()), [
            'name' => $expected['name'],
            'description' => $expected['description'],
            'featured' => $expected['featured'],
            'price_in_cents' => $expected['variants.price_in_cents'],
        ]);
        $product = Product::where('slug', $expected['slug'])->first();

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
     * Update action doesn't updates for an authenticated non-admin user.
     *
     * @return void
     */
    public function test_udpate_doesnt_updates_for_non_admin_users()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $variant = factory(ProductVariant::class)->states('is_master')->create();

        $response = $this->put(route('products.update', Product::first()), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * Update action doesn't updates for an unauthenticated user.
     *
     * @return void
     */
    public function test_update_doesnt_updates_for_non_authenticated_users()
    {
        $variant = factory(ProductVariant::class)->states('is_master')->create();

        $response = $this->put(route('products.update', Product::first()), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * On the update action, the attribute name of a category cannot be empty or null.
     *
     * @return void
     */
    public function test_a_category_name_should_not_be_empty_or_null()
    {
        $user = factory(User::class)->states('is_admin')->make();
        $this->actingAs($user);
        factory(ProductVariant::class)->states('is_master')->create();

        $response = $this->put(route('products.update', Product::first()), [
            'name' => '',
            'description' => $this->faker->text,
            'price_in_cents' => $this->faker->randomNumber(5),
        ]);

        $response->assertSessionHasErrors(['name']);
    }

    /**
     * On the update action, the attribute description of a category cannot be empty or null.
     *
     * @return void
     */
    public function test_a_category_description_should_not_be_empty_or_null()
    {
        $user = factory(User::class)->states('is_admin')->make();
        $this->actingAs($user);
        factory(ProductVariant::class)->states('is_master')->create();

        $response = $this->put(route('products.update', Product::first()), [
            'name' => $this->faker->name,
            'description' => '',
            'price_in_cents' => $this->faker->randomNumber(5),
        ]);

        $response->assertSessionHasErrors(['description']);
    }


    /**
     * On the update action, the attribute price_in_cents of a category cannot be empty or null.
     *
     * @return void
     */
    public function test_a_category_price_in_cents_should_not_be_empty_or_null()
    {
        $user = factory(User::class)->states('is_admin')->make();
        $this->actingAs($user);
        factory(ProductVariant::class)->states('is_master')->create();

        $response = $this->put(route('products.update', Product::first()), [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'price_in_cents' => '',
        ]);

        $response->assertSessionHasErrors(['price_in_cents']);
    }
}
