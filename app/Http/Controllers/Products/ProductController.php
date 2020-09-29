<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
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
        $this->seo()->setTitle(__('navigation.products'));

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
        $this->seo()->setTitle(__('navigation.newest'));

        return view('pages.products.index', ['name' => __('navigation.newest')]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function offers()
    {
        $this->seo()->setTitle(__('navigation.offers'));

        return view('pages.products.index', ['name' => __('navigation.offers')]);
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

        return view('pages.products.show', compact('product'));
    }
}
