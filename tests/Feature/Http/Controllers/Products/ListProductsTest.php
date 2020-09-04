<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ListProductsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A user can retrieve the list of products.
     *
     * @return void
     */
    public function test_a_user_can_list_products()
    {
        $this->withoutExceptionHandling();

        factory(Product::class, 10)->create();
        $products = Product::all();

        $response = $this->get(route('products.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.products.index');
        $response->assertViewHas('products', $products);
    }
}
