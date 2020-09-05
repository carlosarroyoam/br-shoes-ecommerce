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
     * The route displays the view.
     *
     * @return void
     */
    public function test_index_displays_view()
    {
        $products = factory(Product::class, 3)->create();

        $response = $this->get(route('products.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.products.index');
        $response->assertViewHas('products');
    }
}
