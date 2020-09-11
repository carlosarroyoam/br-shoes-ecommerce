<?php

namespace Tests\Feature;

use App\Models\ProductProperty;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ListProductPropertiesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The route displays the view.
     *
     * @return void
     */
    public function test_index_displays_view()
    {
        $categories = ProductProperty::factory()->count(5)->create();

        $response = $this->get(route('product-properties.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.products.properties.index');
        $response->assertViewHas('productProperties');
    }
}
