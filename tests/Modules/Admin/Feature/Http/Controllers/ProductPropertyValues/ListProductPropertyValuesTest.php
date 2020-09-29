<?php

namespace Tests\Modules\Admin\Feature;

use App\Models\ProductPropertyValue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ListProductPropertyValuesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The route displays the view.
     *
     * @return void
     */
    public function test_index_displays_view()
    {
        $this->withoutExceptionHandling();
        $productPropertyValues = ProductPropertyValue::factory()->count(5)->create();

        $response = $this->get(route('admin.product-property-values.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin::pages.products.property-values.index');
        $response->assertViewHas('productPropertyValues');
    }
}
