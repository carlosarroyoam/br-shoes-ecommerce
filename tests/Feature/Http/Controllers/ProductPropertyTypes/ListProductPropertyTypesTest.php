<?php

namespace Tests\Feature;

use App\Models\ProductPropertyType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ListProductPropertyTypesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The route displays the view.
     *
     * @return void
     */
    public function test_index_displays_view()
    {
        $productPropertyTypes = ProductPropertyType::factory()->count(5)->create();

        $response = $this->get(route('product-property-types.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.products.property-types.index');
        $response->assertViewHas('productPropertyTypes');
    }
}
