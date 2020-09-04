<?php

namespace Tests\Feature\Http\Controllers\Products;

use App\ProductVariant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Products\ProductVariantController
 */
class ProductVariantControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $productVariants = factory(ProductVariant::class, 3)->create();

        $response = $this->get(route('product-variant.index'));

        $response->assertOk();
        $response->assertViewIs('productVariant.index');
        $response->assertViewHas('productVariants');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('product-variant.create'));

        $response->assertOk();
        $response->assertViewIs('productVariant.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Products\ProductVariantController::class,
            'store',
            \App\Http\Requests\Products\ProductVariantStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $product_id = $this->faker->randomNumber();
        $price_in_cents = $this->faker->randomNumber();
        $is_master = $this->faker->boolean;

        $response = $this->post(route('product-variant.store'), [
            'product_id' => $product_id,
            'price_in_cents' => $price_in_cents,
            'is_master' => $is_master,
        ]);

        $productVariants = ProductVariant::query()
            ->where('product_id', $product_id)
            ->where('price_in_cents', $price_in_cents)
            ->where('is_master', $is_master)
            ->get();
        $this->assertCount(1, $productVariants);
        $productVariant = $productVariants->first();

        $response->assertRedirect(route('productVariant.index'));
        $response->assertSessionHas('productVariant.id', $productVariant->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $productVariant = factory(ProductVariant::class)->create();

        $response = $this->get(route('product-variant.show', $productVariant));

        $response->assertOk();
        $response->assertViewIs('productVariant.show');
        $response->assertViewHas('productVariant');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $productVariant = factory(ProductVariant::class)->create();

        $response = $this->get(route('product-variant.edit', $productVariant));

        $response->assertOk();
        $response->assertViewIs('productVariant.edit');
        $response->assertViewHas('productVariant');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Products\ProductVariantController::class,
            'update',
            \App\Http\Requests\Products\ProductVariantUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $productVariant = factory(ProductVariant::class)->create();
        $product_id = $this->faker->randomNumber();
        $price_in_cents = $this->faker->randomNumber();
        $is_master = $this->faker->boolean;

        $response = $this->put(route('product-variant.update', $productVariant), [
            'product_id' => $product_id,
            'price_in_cents' => $price_in_cents,
            'is_master' => $is_master,
        ]);

        $productVariant->refresh();

        $response->assertRedirect(route('productVariant.index'));
        $response->assertSessionHas('productVariant.id', $productVariant->id);

        $this->assertEquals($product_id, $productVariant->product_id);
        $this->assertEquals($price_in_cents, $productVariant->price_in_cents);
        $this->assertEquals($is_master, $productVariant->is_master);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $productVariant = factory(ProductVariant::class)->create();

        $response = $this->delete(route('product-variant.destroy', $productVariant));

        $response->assertRedirect(route('productVariant.index'));

        $this->assertDeleted($productVariant);
    }
}
