<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * An admin can update products.
     *
     * @return void
     */
    public function test_an_admin_can_update_products()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->states('admin')->make();
        $this->actingAs($user);
        $product = factory(Product::class)->create();
        $expected = [
            'name' => 'Snake Sneakers',
            'slug' => 'snake-sneakers',
            'description' => 'Snake print sneakers.',
            'featured' => false,
            'variants.price_in_cents' => 36000,
            'variants.is_master' => true,
        ];

        $response = $this->putJson(route('products.update', $product), [
            'name' => $expected['name'],
            'description' => $expected['description'],
            'featured' => $expected['featured'],
            'price_in_cents' => $expected['variants.price_in_cents'],
        ]);

        $response->assertRedirect(route('products.show', $expected['slug']));
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
     * An authenticated non-admin user cannot update products.
     *
     * @return void
     */
    public function test_a_user_cannot_update_products()
    {
        $user = factory(User::class)->make();
        $this->actingAs($user);
        $product = factory(Product::class)->create();
        $expected = [
            'name' => 'Snake Sneakers',
            'slug' => 'snake-sneakers',
            'description' => 'Snake print sneakers.',
            'featured' => false,
            'variants.price_in_cents' => 36000,
        ];

        $response = $this->putJson(route('products.update', $product), [
            'name' => $expected['name'],
            'description' => $expected['description'],
            'featured' => $expected['featured'],
            'price_in_cents' => $expected['variants.price_in_cents'],
        ]);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * An unauthenticated user cannot update products.
     *
     * @return void
     */
    public function test_an_unauthenticated_user_cannot_update_products()
    {
        $product = factory(Product::class)->create();
        $expected = [
            'name' => 'Snake Sneakers',
            'slug' => 'snake-sneakers',
            'description' => 'Snake print sneakers.',
            'featured' => false,
            'variants.price_in_cents' => 36000,
        ];

        $response = $this->putJson(route('products.update', $product), [
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
        $user = factory(User::class)->states('admin')->make();
        $this->actingAs($user);
        $product = factory(Product::class)->create();
        $expected = [
            'name' => '',
            'slug' => 'snake-sneakers',
            'description' => 'Snake print sneakers.',
            'featured' => false,
            'variants.price_in_cents' => 36000,
        ];

        $response = $this->putJson(route('products.update', $product), [
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
    public function test_a_description_name_should_not_be_empty()
    {
        $user = factory(User::class)->states('admin')->make();
        $this->actingAs($user);
        $product = factory(Product::class)->create();
        $expected = [
            'name' => 'Snake Sneakers',
            'slug' => 'snake-sneakers',
            'description' => '',
            'featured' => false,
            'variants.price_in_cents' => 36000,
        ];

        $response = $this->putJson(route('products.update', $product), [
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
        $user = factory(User::class)->states('admin')->make();
        $this->actingAs($user);
        $expected = [
            'name' => 'Snake Sneakers',
            'slug' => 'snake-sneakers',
            'description' => '',
            'featured' => false,
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
