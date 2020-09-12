<?php

namespace Tests\Feature;

use App\Models\Product;
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
        $products = Product::factory()->count(5)->create();

        $response = $this->get(route('products.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.products.index');
        $response->assertViewHas('products');
    }
}
