<?php

namespace Tests\Feature;

use App\Product;
use App\User;
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
        $this->withoutExceptionHandling();

        $user = factory(User::class)->states('is_admin')->make();
        $this->actingAs($user);

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
        $this->withoutExceptionHandling();

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
        $this->withoutExceptionHandling();

        $user = factory(User::class)->states('is_admin')->make();
        $this->actingAs($user);
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
     * An authenticated non-admin user cannot create products.
     *
     * @return void
     */
    public function test_a_user_cannot_create_products()
    {
        $user = factory(User::class)->make();
        $this->actingAs($user);
        $expected = [
            'name' => 'Snake Sneakers',
            'slug' => 'snake-sneakers',
            'description' => 'Snake print sneakers.',
            'featured' => false,
            'variants.price_in_cents' => 36000,
            'variants.is_master' => true,
        ];

        $response = $this->postJson(route('products.store'), [
            'name' => $expected['name'],
            'description' => $expected['description'],
            'featured' => $expected['featured'],
            'price_in_cents' => $expected['variants.price_in_cents'],
        ]);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * An unauthenticated user cannot create products.
     *
     * @return void
     */
    public function test_an_unauthenticated_user_cannot_create_products()
    {
        $expected = [
            'name' => 'Snake Sneakers',
            'slug' => 'snake-sneakers',
            'description' => 'Snake print sneakers.',
            'featured' => false,
            'variants.price_in_cents' => 36000,
            'variants.is_master' => true,
        ];

        $response = $this->postJson(route('products.store'), [
            'name' => $expected['name'],
            'description' => $expected['description'],
            'featured' => $expected['featured'],
            'price_in_cents' => $expected['variants.price_in_cents'],
        ]);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * The attribute name of a product cannot be empty.
     *
     * @return void
     */
    public function test_a_product_name_should_not_be_empty()
    {
        $user = factory(User::class)->states('is_admin')->make();
        $this->actingAs($user);
        $expected = [
            'name' => '',
            'slug' => 'snake-sneakers',
            'description' => 'Snake print sneakers.',
            'featured' => false,
            'variants.price_in_cents' => 36000,
            'variants.is_master' => true,
        ];

        $response = $this->postJson(route('products.store'), [
            'name' => $expected['name'],
            'description' => $expected['description'],
            'featured' => $expected['featured'],
            'price_in_cents' => $expected['variants.price_in_cents'],
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors(['name']);
    }

    /**
     * The attribute description of a product cannot be empty.
     *
     * @return void
     */
    public function test_a_product_description_should_not_be_empty()
    {
        $user = factory(User::class)->states('is_admin')->make();
        $this->actingAs($user);
        $expected = [
            'name' => 'Snake Sneakers',
            'slug' => 'snake-sneakers',
            'description' => '',
            'featured' => false,
            'variants.price_in_cents' => 36000,
            'variants.is_master' => true,
        ];

        $response = $this->postJson(route('products.store'), [
            'name' => $expected['name'],
            'description' => $expected['description'],
            'featured' => $expected['featured'],
            'price_in_cents' => $expected['variants.price_in_cents'],
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors(['description']);
    }

    /**
     * The attribute price_in_cents of a product cannot be empty.
     *
     * @return void
     */
    public function test_a_product_price_in_cents_should_not_be_empty()
    {
        $user = factory(User::class)->states('is_admin')->make();
        $this->actingAs($user);
        $expected = [
            'name' => 'Snake Sneakers',
            'slug' => 'snake-sneakers',
            'description' => '',
            'featured' => false,
            'variants.is_master' => true,
        ];

        $response = $this->postJson(route('products.store'), [
            'name' => $expected['name'],
            'description' => $expected['description'],
            'featured' => $expected['featured'],
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors(['price_in_cents']);
    }
}
