<?php

namespace Modules\Admin\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\Products\ProductStoreRequest;
use Modules\Admin\Http\Requests\Products\ProductUpdateRequest;
use Modules\Admin\Services\ProductService;

class ProductController extends Controller
{
    /**
     * The product service instance.
     */
    protected $productService;

    /**
     * Create a new controller instance.
     *
     * @param  \Modules\Admin\Services\ProductService  $productService
     * @return void
     */
    public function __construct(ProductService $productService)
    {
        $this->authorizeResource(Product::class, 'product');
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->seo()->setTitle(__('navigation.products'));

        $products = $this->productService->getAll();

        return view('admin::pages.products.index', compact('products'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newest()
    {
        $this->seo()->setTitle(__('navigation.newest'));

        return view('admin::pages.products.index', ['name' => __('navigation.newest')]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function offers()
    {
        $this->seo()->setTitle(__('navigation.offers'));

        return view('admin::pages.products.index', ['name' => __('navigation.offers')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('admin::pages.products.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Modules\Admin\Http\Requests\Products\ProductStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $product = $this->productService->create($request->validated());

        $request->session()->flash('product.id', $product->id);

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $this->seo()->setTitle($product->name);
        $this->seo()->setDescription($product->description);

        return view('admin::pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin::pages.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Modules\Admin\Http\Requests\Products\ProductUpdateRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $updatedProduct = $this->productService->update($request->validated(), $product);

        $request->session()->flash('product.id', $updatedProduct->id);

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->productService->delete($product);

        return redirect()->route('admin.products.index');
    }
}
