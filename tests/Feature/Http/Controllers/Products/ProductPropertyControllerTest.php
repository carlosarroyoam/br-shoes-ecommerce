<?php

namespace Tests\Feature\Http\Controllers\Products;

use App\ProductProperty;
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

        $response = $this->get(route('product-property.index'));

        $response->assertOk();
        $response->assertViewIs('productProperty.index');
        $response->assertViewHas('productProperties');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('product-property.create'));

        $response->assertOk();
        $response->assertViewIs('productProperty.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Products\ProductPropertyController::class,
            'store',
            \App\Http\Requests\Products\ProductPropertyStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $product_id = $this->faker->randomNumber();
        $property_type_id = $this->faker->randomNumber();
        $value = $this->faker->word;

        $response = $this->post(route('product-property.store'), [
            'product_id' => $product_id,
            'property_type_id' => $property_type_id,
            'value' => $value,
        ]);

        $productProperties = ProductProperty::query()
            ->where('product_id', $product_id)
            ->where('property_type_id', $property_type_id)
            ->where('value', $value)
            ->get();
        $this->assertCount(1, $productProperties);
        $productProperty = $productProperties->first();

        $response->assertRedirect(route('productProperty.index'));
        $response->assertSessionHas('productProperty.id', $productProperty->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $productProperty = factory(ProductProperty::class)->create();

        $response = $this->get(route('product-property.show', $productProperty));

        $response->assertOk();
        $response->assertViewIs('productProperty.show');
        $response->assertViewHas('productProperty');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $productProperty = factory(ProductProperty::class)->create();

        $response = $this->get(route('product-property.edit', $productProperty));

        $response->assertOk();
        $response->assertViewIs('productProperty.edit');
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
            \App\Http\Requests\Products\ProductPropertyUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $productProperty = factory(ProductProperty::class)->create();
        $product_id = $this->faker->randomNumber();
        $property_type_id = $this->faker->randomNumber();
        $value = $this->faker->word;

        $response = $this->put(route('product-property.update', $productProperty), [
            'product_id' => $product_id,
            'property_type_id' => $property_type_id,
            'value' => $value,
        ]);

        $productProperty->refresh();

        $response->assertRedirect(route('productProperty.index'));
        $response->assertSessionHas('productProperty.id', $productProperty->id);

        $this->assertEquals($product_id, $productProperty->product_id);
        $this->assertEquals($property_type_id, $productProperty->property_type_id);
        $this->assertEquals($value, $productProperty->value);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $productProperty = factory(ProductProperty::class)->create();

        $response = $this->delete(route('product-property.destroy', $productProperty));

        $response->assertRedirect(route('productProperty.index'));

        $this->assertDeleted($productProperty);
    }
}
