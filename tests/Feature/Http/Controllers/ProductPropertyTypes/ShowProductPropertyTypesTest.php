<?php

namespace Tests\Feature;

use App\Models\ProductPropertyType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ShowProductPropertyTypesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * The route displays the view.
     *
     * @return void
     */
    public function test_show_displays_view()
    {
        $productPropertyType = ProductPropertyType::factory()->create();

        $response = $this->get(route('product-property-types.show', $productPropertyType));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.products.property-types.show');
        $response->assertViewHas('productPropertyType', $productPropertyType);
    }

    /**
     * The route doesn't display the view when the resource doesn't exist.
     *
     * @return void
     */
    public function test_show_doesnt_display_view_if_resource_doesnt_exist()
    {
        $nonExistingName = $this->faker->name;

        $response = $this->get(route('product-property-types.show', $nonExistingName));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
