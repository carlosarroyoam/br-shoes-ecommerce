<?php

namespace Tests\Modules\Admin\Feature;

use App\Models\ProductVariant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ListProductVariantsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The route displays the view.
     *
     * @return void
     */
    public function test_index_displays_view()
    {
        $productVariants = ProductVariant::factory()->count(5)->create();

        $response = $this->get(route('admin.product-variants.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin::pages.products.variants.index');
        $response->assertViewHas('productVariants');
    }
}
