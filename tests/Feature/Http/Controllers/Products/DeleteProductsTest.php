<?php

namespace Tests\Feature;

use App\Product;
use App\ProductVariant;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DeleteProductsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Destroy action deletes and redirects to index for an admin user.
     *
     * @return void
     */
    public function test_destroy_deletes_and_redirects_for_admin_users()
    {
        $user = factory(User::class)->states('is_admin')->create();
        $this->actingAs($user);
        $variant = factory(ProductVariant::class)->states('is_master')->create();
        $product = Product::first();

        $response = $this->delete(route('products.destroy', $product));

        $response->assertRedirect(route('products.index'));
        $this->assertDeleted($product);
        $this->assertDeleted($variant);
    }

    /**
     * Destroy action doesn't delete for an authenticated non-admin user.
     *
     * @return void
     */
    public function test_destroy_dont_deletes_for_non_admin_users()
    {
        $user = factory(User::class)->make();
        $this->actingAs($user);
        $variant = factory(ProductVariant::class)->states('is_master')->create();
        $product = Product::first();

        $response = $this->deleteJson(route('products.destroy', $product));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * Destroy action doesn't deletes for an unauthenticated user.
     *
     * @return void
     */
    public function test_destroy_dont_deletes_for_non_authenticated_users()
    {
        $variant = factory(ProductVariant::class)->states('is_master')->create();
        $product = Product::first();

        $response = $this->delete(route('products.destroy', $product));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
