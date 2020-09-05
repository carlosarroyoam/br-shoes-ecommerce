<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ShowProductsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * The route displays the view.
     *
     * @return void
     */
    public function test_show_displays_view()
    {
        $product = factory(Product::class)->create();

        $response = $this->get(route('products.show', $product->slug));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.products.show');
        $response->assertViewHas('product', $product);
    }

    /**
     * The route doesn't display the view when the resource doesn't exist.
     *
     * @return void
     */
    public function test_a_user_cannot_get_a_product_if_doesnt_exists()
    {
        $nonExistingSlug = Str::slug($this->faker->name);

        $response = $this->get(route('products.show', $nonExistingSlug));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
