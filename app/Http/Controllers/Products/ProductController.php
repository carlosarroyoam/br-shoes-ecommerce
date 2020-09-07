<?php

namespace App\Http\Controllers\Products;

use App\Product;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductStoreRequest;
use App\Http\Requests\Products\ProductUpdateRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * The product service instance.
     */
    protected $productService;

    /**
     * Create a new controller instance.
     *
     * @param  ProductService  $productService
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
        $products = $this->productService->getAll();

        return view('pages.products.index', compact('products'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newest()
    {
        return view('pages.products.index', ['name' => __('navigation.newest')]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function offers()
    {
        return view('pages.products.index', ['name' => __('navigation.offers')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('pages.products.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $product = $this->productService->create($request->validated());

        $request->session()->flash('product.id', $product->id);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('pages.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $updatedProduct = $this->productService->update($request->validated(), $product);

        $request->session()->flash('product.id', $updatedProduct->id);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->productService->delete($product);

        return redirect()->route('products.index');
    }
}
