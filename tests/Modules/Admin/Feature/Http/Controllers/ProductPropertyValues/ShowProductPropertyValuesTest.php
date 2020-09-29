<?php

namespace Tests\Modules\Admin\Feature;

use App\Models\ProductPropertyValue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ShowProductPropertyValuesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * The route displays the view.
     *
     * @return void
     */
    public function test_show_displays_view()
    {
        $productPropertyValue = ProductPropertyValue::factory()->create();

        $response = $this->get(route('admin.product-property-values.show', $productPropertyValue));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin::pages.products.property-values.show');
        $response->assertViewHas('productPropertyValue', $productPropertyValue);
    }

    /**
     * The route doesn't display the view when the resource doesn't exist.
     *
     * @return void
     */
    public function test_show_doesnt_display_view_if_resource_doesnt_exist()
    {
        $nonExistingSlug = Str::slug($this->faker->name);

        $response = $this->get(route('admin.product-property-values.show', $nonExistingSlug));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
