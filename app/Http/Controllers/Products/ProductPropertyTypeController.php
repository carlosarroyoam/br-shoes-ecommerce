<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\PropertyTypes\ProductPropertyTypeStoreRequest;
use App\Http\Requests\Products\PropertyTypes\ProductPropertyTypeUpdateRequest;
use App\Models\ProductPropertyType;
use App\Services\ProductPropertyTypeService;
use Illuminate\Http\Request;

class ProductPropertyTypeController extends Controller
{
    /**
     * The product property service instance.
     *
     * @var \App\Services\ProductPropertyTypeService
     */
    protected $productPropertyTypeService;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\ProductPropertyTypeService  $productPropertyTypeService
     * @return void
     */
    public function __construct(ProductPropertyTypeService $productPropertyTypeService)
    {
        $this->authorizeResource(ProductPropertyType::class, 'product_property_type');
        $this->productPropertyTypeService = $productPropertyTypeService;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productPropertyTypes = $this->productPropertyTypeService->getAll();

        return view('pages.products.property-types.index', compact('productPropertyTypes'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('pages.products.property-types.create');
    }

    /**
     * @param \App\Http\Requests\Products\ProductPropertyTypeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductPropertyTypeStoreRequest $request)
    {
        $productPropertyType = $this->productPropertyTypeService->create($request->validated());

        $request->session()->flash('productPropertyType.id', $productPropertyType->id);

        return redirect()->route('product-property-types.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\ProductPropertyType $productPropertyType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ProductPropertyType $productPropertyType)
    {
        return view('pages.products.property-types.show', compact('productPropertyType'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\ProductPropertyType $productPropertyType
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ProductPropertyType $productPropertyType)
    {
        return view('pages.products.property-types.edit', compact('productPropertyType'));
    }

    /**
     * @param \App\Http\Requests\Products\ProductPropertyTypeUpdateRequest $request
     * @param \App\ProductPropertyType $productPropertyType
     * @return \Illuminate\Http\Response
     */
    public function update(ProductPropertyTypeUpdateRequest $request, ProductPropertyType $productPropertyType)
    {
        $updatedProductPropertyType = $this->productPropertyTypeService->update($request->validated(), $productPropertyType);

        $request->session()->flash('productPropertyType.id', $updatedProductPropertyType->id);

        return redirect()->route('product-property-types.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\ProductPropertyType $productPropertyType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductPropertyType $productPropertyType)
    {
        $this->productPropertyTypeService->delete($productPropertyType);

        return redirect()->route('product-property-types.index');
    }
}
