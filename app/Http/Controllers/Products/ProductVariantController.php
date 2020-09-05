<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\Variants\ProductVariantStoreRequest;
use App\Http\Requests\Products\Variants\ProductVariantUpdateRequest;
use App\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productVariants = ProductVariant::all();

        return view('pages.products.variants.index', compact('productVariants'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('pages.products.variants.create');
    }

    /**
     * @param \App\Http\Requests\Products\ProductVariantStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductVariantStoreRequest $request)
    {
        $productVariant = ProductVariant::create($request->validated());

        $request->session()->flash('productVariant.id', $productVariant->id);

        return redirect()->route('product-variants.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\ProductVariant $productVariant
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ProductVariant $productVariant)
    {
        return view('pages.products.variants.show', compact('productVariant'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\ProductVariant $productVariant
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ProductVariant $productVariant)
    {
        return view('pages.products.variants.edit', compact('productVariant'));
    }

    /**
     * @param \App\Http\Requests\Products\ProductVariantUpdateRequest $request
     * @param \App\ProductVariant $productVariant
     * @return \Illuminate\Http\Response
     */
    public function update(ProductVariantUpdateRequest $request, ProductVariant $productVariant)
    {
        $productVariant->update($request->validated());

        $request->session()->flash('productVariant.id', $productVariant->id);

        return redirect()->route('product-variants.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\ProductVariant $productVariant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ProductVariant $productVariant)
    {
        $productVariant->delete();

        return redirect()->route('product-variants.index');
    }
}
