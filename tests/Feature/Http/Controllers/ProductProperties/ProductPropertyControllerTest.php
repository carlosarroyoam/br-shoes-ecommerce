<?php

namespace Tests\Feature\Http\Controllers\Products;

use App\Product;
use App\ProductProperty;
use App\ProductPropertyType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Products\ProductPropertyController
 */
class ProductPropertyControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $productProperties = factory(ProductProperty::class, 3)->create();

        $response = $this->get(route('product-properties.index'));

        $response->assertOk();
        $response->assertViewIs('pages.products.properties.index');
        $response->assertViewHas('productProperties');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('product-properties.create'));

        $response->assertOk();
        $response->assertViewIs('pages.products.properties.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Products\ProductPropertyController::class,
            'store',
            \App\Http\Requests\Products\Properties\ProductPropertyStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $product = factory(Product::class)->create();
        $property_type = factory(ProductProperty::class)->create();
        $value = $this->faker->word;

        $response = $this->post(route('product-properties.store'), [
            'product_id' => $product->id,
            'property_type_id' => $property_type->id,
            'value' => $value,
        ]);

        $productProperties = ProductProperty::query()
            ->where('product_id', $product->id)
            ->where('property_type_id', $property_type->id)
            ->where('value', $value)
            ->get();
        $this->assertCount(1, $productProperties);
        $productProperty = $productProperties->first();

        $response->assertRedirect(route('product-properties.index'));
        $response->assertSessionHas('productProperty.id', $productProperty->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $productProperty = factory(ProductProperty::class)->create();

        $response = $this->get(route('product-properties.show', $productProperty));

        $response->assertOk();
        $response->assertViewIs('pages.products.properties.show');
        $response->assertViewHas('productProperty');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $productProperty = factory(ProductProperty::class)->create();

        $response = $this->get(route('product-properties.edit', $productProperty));

        $response->assertOk();
        $response->assertViewIs('pages.products.properties.edit');
        $response->assertViewHas('productProperty');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Products\ProductPropertyController::class,
            'update',
            \App\Http\Requests\Products\Properties\ProductPropertyUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $productProperty = factory(ProductProperty::class)->create();
        $product = factory(Product::class)->create();
        $property_type = factory(ProductPropertyType::class)->create();
        $value = $this->faker->word;

        $response = $this->put(route('product-properties.update', $productProperty), [
            'product_id' => $product->id,
            'property_type_id' => $property_type->id,
            'value' => $value,
        ]);

        $productProperty->refresh();

        $response->assertRedirect(route('product-properties.index'));
        $response->assertSessionHas('productProperty.id', $productProperty->id);

        $this->assertEquals($product->id, $productProperty->product_id);
        $this->assertEquals($property_type->id, $productProperty->property_type_id);
        $this->assertEquals($value, $productProperty->value);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $productProperty = factory(ProductProperty::class)->create();

        $response = $this->delete(route('product-properties.destroy', $productProperty));

        $response->assertRedirect(route('product-properties.index'));

        $this->assertDeleted($productProperty);
    }
}