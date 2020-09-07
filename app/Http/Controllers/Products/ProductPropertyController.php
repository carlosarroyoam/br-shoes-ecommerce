<?php

namespace App\Http\Controllers\Products;

use App\ProductProperty;
use App\Http\Controllers\Controller;
use App\Services\ProductPropertyService;
use App\Http\Requests\Products\Properties\ProductPropertyStoreRequest;
use App\Http\Requests\Products\Properties\ProductPropertyUpdateRequest;
use Illuminate\Http\Request;

class ProductPropertyController extends Controller
{
    /**
     * The product property service instance.
     *
     * @var \App\Services\ProductPropertyService
     */
    protected $categoryService;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\ProductPropertyService  $productPropertyService
     * @return void
     */
    public function __construct(ProductPropertyService $productPropertyService)
    {
        $this->authorizeResource(ProductProperty::class, 'product-property');
        $this->productPropertyService = $productPropertyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productProperties = $this->productPropertyService->getAll();

        return view('pages.products.properties.index', compact('productProperties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('pages.products.properties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Products\ProductPropertyStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductPropertyStoreRequest $request)
    {
        $productProperty = $this->productPropertyService->create($request->validated());

        $request->session()->flash('productProperty.id', $productProperty->id);

        return redirect()->route('product-properties.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ProductProperty $productProperty
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ProductProperty $productProperty)
    {
        return view('pages.products.properties.show', compact('productProperty'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ProductProperty $productProperty
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ProductProperty $productProperty)
    {
        return view('pages.products.properties.edit', compact('productProperty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Products\ProductPropertyUpdateRequest $request
     * @param \App\ProductProperty $productProperty
     * @return \Illuminate\Http\Response
     */
    public function update(ProductPropertyUpdateRequest $request, ProductProperty $productProperty)
    {
        $updatedProductProperty = $this->productPropertyService->update($request->validated(), $productProperty);

        $request->session()->flash('productProperty.id', $updatedProductProperty->id);

        return redirect()->route('product-properties.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ProductProperty $productProperty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ProductProperty $productProperty)
    {
        $this->productPropertyService->delete($productProperty);

        return redirect()->route('product-properties.index');
    }
}
