<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductPicturesStoreRequest;
use App\Http\Requests\Products\ProductPicturesUpdateRequest;
use App\Products\ProductPicture;
use App\Products\productPicture;
use Illuminate\Http\Request;

class ProductPicturesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productPictures = ProductPicture::all();

        return view('productPicture.index', compact('productPictures'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('productPicture.create');
    }

    /**
     * @param \App\Http\Requests\Products\ProductPicturesStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductPicturesStoreRequest $request)
    {
        $productPicture = ProductPicture::create($request->validated());

        $request->session()->flash('productPicture.id', $productPicture->id);

        return redirect()->route('productPicture.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Products\productPicture $productPicture
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ProductPicture $productPicture)
    {
        return view('productPicture.show', compact('productPicture'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Products\productPicture $productPicture
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ProductPicture $productPicture)
    {
        return view('productPicture.edit', compact('productPicture'));
    }

    /**
     * @param \App\Http\Requests\Products\ProductPicturesUpdateRequest $request
     * @param \App\Products\productPicture $productPicture
     * @return \Illuminate\Http\Response
     */
    public function update(ProductPicturesUpdateRequest $request, ProductPicture $productPicture)
    {
        $productPicture->update($request->validated());

        $request->session()->flash('productPicture.id', $productPicture->id);

        return redirect()->route('productPicture.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Products\productPicture $productPicture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ProductPicture $productPicture)
    {
        $productPicture->delete();

        return redirect()->route('productPicture.index');
    }
}
