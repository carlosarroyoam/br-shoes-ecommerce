<?php

namespace Modules\Admin\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\Products\Variants\ProductVariantStoreRequest;
use Modules\Admin\Http\Requests\Products\Variants\ProductVariantUpdateRequest;
use Modules\Admin\Services\ProductVariantService;

class ProductVariantController extends Controller
{
    /**
     * The product variant service instance.
     */
    protected $productVariantService;

    /**
     * Create a new controller instance.
     *
     * @param  \Modules\Admin\Services\ProductVariantService  $productVariantService
     * @return void
     */
    public function __construct(ProductVariantService $productVariantService)
    {
        $this->authorizeResource(ProductVariant::class, 'product_variant');
        $this->productVariantService = $productVariantService;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productVariants = $this->productVariantService->getAll();

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
     * @param \App\Models\Http\Requests\Products\Variants\ProductVariantStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductVariantStoreRequest $request)
    {
        $productVariant = $this->productVariantService->create($request->validated());

        $request->session()->flash('productVariant.id', $productVariant->id);

        return redirect()->route('admin.product-variants.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductVariant $productVariant
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ProductVariant $productVariant)
    {
        return view('admin::pages.products.variants.show', compact('productVariant'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductVariant $productVariant
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ProductVariant $productVariant)
    {
        return view('admin::pages.products.variants.edit', compact('productVariant'));
    }

    /**
     * @param \App\Models\Http\Requests\Products\Variants\ProductVariantUpdateRequest $request
     * @param \App\Models\ProductVariant $productVariant
     * @return \Illuminate\Http\Response
     */
    public function update(ProductVariantUpdateRequest $request, ProductVariant $productVariant)
    {
        $udpatedProductVariant = $this->productVariantService->update($request->validated(), $productVariant);

        $request->session()->flash('productVariant.id', $udpatedProductVariant->id);

        return redirect()->route('admin.product-variants.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductVariant $productVariant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ProductVariant $productVariant)
    {
        $this->productVariantService->delete($productVariant);

        return redirect()->route('admin.product-variants.index');
    }
}
