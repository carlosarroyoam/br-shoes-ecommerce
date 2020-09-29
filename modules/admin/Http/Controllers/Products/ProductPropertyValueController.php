<?php

namespace Modules\Admin\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\ProductPropertyValue;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\Products\PropertyValues\ProductPropertyValueStoreRequest;
use Modules\Admin\Http\Requests\Products\PropertyValues\ProductPropertyValueUpdateRequest;
use Modules\Admin\Services\ProductPropertyValueService;

class ProductPropertyValueController extends Controller
{
    /**
     * The product property service instance.
     *
     * @var \App\Services\ProductPropertyValueService
     */
    protected $productPropertyValueService;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\ProductPropertyValueService $productPropertyValueService
     * @return void
     */
    public function __construct(ProductPropertyValueService $productPropertyValueService)
    {
        $this->authorizeResource(ProductPropertyValue::class, 'product_property_value');
        $this->productPropertyValueService = $productPropertyValueService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productPropertyValues = $this->productPropertyValueService->getAll();

        return view('admin::pages.products.property-values.index', compact('productPropertyValues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin::pages.products.property-values.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Products\ProductPropertyValueStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductPropertyValueStoreRequest $request)
    {
        $productPropertyValue = $this->productPropertyValueService->create($request->validated());

        $request->session()->flash('productPropertyValue.id', $productPropertyValue->id);

        return redirect()->route('admin.product-property-values.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ProductPropertyValue $productPropertyValue
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ProductPropertyValue $productPropertyValue)
    {
        return view('admin::pages.products.property-values.show', compact('productPropertyValue'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ProductPropertyValue $productPropertyValue
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ProductPropertyValue $productPropertyValue)
    {
        return view('admin::pages.products.property-values.edit', compact('productPropertyValue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Products\ProductPropertyValueUpdateRequest $request
     * @param \App\ProductPropertyValue $productPropertyValue
     * @return \Illuminate\Http\Response
     */
    public function update(ProductPropertyValueUpdateRequest $request, ProductPropertyValue $productPropertyValue)
    {
        $updatedProductPropertyValue = $this->productPropertyValueService->update($request->validated(), $productPropertyValue);

        $request->session()->flash('productPropertyValue.id', $updatedProductPropertyValue->id);

        return redirect()->route('admin.product-property-values.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ProductPropertyValue $productPropertyValue
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductPropertyValue $productPropertyValue)
    {
        $this->productPropertyValueService->delete($productPropertyValue);

        return redirect()->route('admin.product-property-values.index');
    }
}
