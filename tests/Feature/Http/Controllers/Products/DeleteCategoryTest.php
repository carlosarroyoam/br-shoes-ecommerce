<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * An admin can delete products.
     *
     * @return void
     */
    public function test_an_admin_can_delete_products()
    {
        $user = factory(User::class)->states('admin')->make();
        $this->actingAs($user);
        $product = factory(Product::class)->create();

        $response = $this->deleteJson(route('products.destroy', $product));

        $response->assertRedirect(route('products.index'));
        $this->assertDeleted('products', [
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'description' => $product->description,
        ]);
        $this->assertDeleted('product_variants', [
            'product_id' => $product->id,
        ]);
    }

    /**
     * An authenticated non-admin user cannot delete products.
     *
     * @return void
     */
    public function test_a_user_cannot_delete_products()
    {
        $user = factory(User::class)->make();
        $this->actingAs($user);
        $product = factory(Product::class)->create();

        $response = $this->deleteJson(route('products.destroy', $product));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * An unauthenticated user cannot delete products.
     *
     * @return void
     */
    public function test_an_unauthenticated_user_cannot_delete_products()
    {
        $product = factory(Product::class)->create();

        $response = $this->deleteJson(route('products.destroy', $product));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
