<?php

namespace Modules\Admin\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\Products\Variants\ProductVariantStoreRequest;
use Modules\Admin\Http\Requests\Products\Variants\ProductVariantUpdateRequest;

class ProductVariantController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productVariants = ProductVariant::all();

        return view('admin::pages.products.variants.index', compact('productVariants'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin::pages.products.variants.create');
    }

    /**
     * @param \App\Http\Requests\Products\ProductVariantStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductVariantStoreRequest $request)
    {
        $productVariant = ProductVariant::create($request->validated());

        $request->session()->flash('productVariant.id', $productVariant->id);

        return redirect()->route('admin.product-variants.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\ProductVariant $productVariant
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ProductVariant $productVariant)
    {
        return view('admin::pages.products.variants.show', compact('productVariant'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\ProductVariant $productVariant
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ProductVariant $productVariant)
    {
        return view('admin::pages.products.variants.edit', compact('productVariant'));
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

        return redirect()->route('admin.product-variants.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\ProductVariant $productVariant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ProductVariant $productVariant)
    {
        $productVariant->delete();

        return redirect()->route('admin.product-variants.index');
    }
}
