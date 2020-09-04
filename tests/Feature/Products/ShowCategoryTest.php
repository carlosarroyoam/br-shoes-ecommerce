<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ShowProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A user can retrieve a specified product.
     *
     * @return void
     */
    public function test_a_user_can_get_a_product()
    {
        $product = factory(Product::class)->create();

        $response = $this->get(route('products.show', $product->slug));

        $product = Product::first();

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.products.show');
        $response->assertViewHas('product', $product);
    }

    /**
     * A user cannot retrieve a specified product if the product doesn't exist.
     *
     * @return void
     */
    public function test_a_user_cannot_get_a_product_if_doesnt_exists()
    {
        $nonExistingSlug = 'snake-sneaker';

        $response = $this->get(route('products.show', $nonExistingSlug));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
