<?php

namespace Tests\Feature\Http\Controllers\Products;

use App\Models\ProductPropertyType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Products\ProductPropertyTypeController
 */
class ProductPropertyTypeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $productPropertyTypes = factory(ProductPropertyType::class, 3)->create();

        $response = $this->get(route('product-property-types.index'));

        $response->assertOk();
        $response->assertViewIs('pages.products.property-types.index');
        $response->assertViewHas('productPropertyTypes');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('product-property-types.create'));

        $response->assertOk();
        $response->assertViewIs('pages.products.property-types.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Products\ProductPropertyTypeController::class,
            'store',
            \App\Http\Requests\Products\PropertyTypes\ProductPropertyTypeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;

        $response = $this->post(route('product-property-types.store'), [
            'name' => $name,
        ]);

        $productPropertyTypes = ProductPropertyType::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $productPropertyTypes);
        $productPropertyType = $productPropertyTypes->first();

        $response->assertRedirect(route('product-property-types.index'));
        $response->assertSessionHas('productPropertyType.id', $productPropertyType->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $productPropertyType = factory(ProductPropertyType::class)->create();

        $response = $this->get(route('product-property-types.show', $productPropertyType));

        $response->assertOk();
        $response->assertViewIs('pages.products.property-types.show');
        $response->assertViewHas('productPropertyType');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $productPropertyType = factory(ProductPropertyType::class)->create();

        $response = $this->get(route('product-property-types.edit', $productPropertyType));

        $response->assertOk();
        $response->assertViewIs('pages.products.property-types.edit');
        $response->assertViewHas('productPropertyType');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Products\ProductPropertyTypeController::class,
            'update',
            \App\Http\Requests\Products\PropertyTypes\ProductPropertyTypeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $productPropertyType = factory(ProductPropertyType::class)->create();
        $name = $this->faker->name;

        $response = $this->put(route('product-property-types.update', $productPropertyType), [
            'name' => $name,
        ]);

        $productPropertyType->refresh();

        $response->assertRedirect(route('product-property-types.index'));
        $response->assertSessionHas('productPropertyType.id', $productPropertyType->id);

        $this->assertEquals($name, $productPropertyType->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $productPropertyType = factory(ProductPropertyType::class)->create();

        $response = $this->delete(route('product-property-types.destroy', $productPropertyType));

        $response->assertRedirect(route('product-property-types.index'));

        $this->assertDeleted($productPropertyType);
    }
}
