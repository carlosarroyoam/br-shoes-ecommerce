<?php

namespace Tests\Modules\Admin\Feature;

use App\Models\ProductVariant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ShowProductVariantsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * The route displays the view.
     *
     * @return void
     */
    public function test_show_displays_view()
    {
        $productVariant = ProductVariant::factory()->create();

        $response = $this->get(route('admin.product-variants.show', $productVariant));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin::pages.products.variants.show');
        $response->assertViewHas('productVariant', $productVariant);
    }

    /**
     * The route doesn't display the view when the resource doesn't exist.
     *
     * @return void
     */
    public function test_show_doesnt_display_view_if_resource_doesnt_exist()
    {
        $nonExistingName = $this->faker->name;

        $response = $this->get(route('admin.product-variants.show', $nonExistingName));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
