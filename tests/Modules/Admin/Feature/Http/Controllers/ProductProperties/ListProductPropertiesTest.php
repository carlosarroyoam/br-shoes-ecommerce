<?php

namespace Tests\Modules\Admin\Feature;

use App\Models\ProductProperty;
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
        $productProperties = ProductProperty::factory()->count(5)->create();

        $response = $this->get(route('admin.product-properties.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin::pages.products.properties.index');
        $response->assertViewHas('productProperties');
    }
}
