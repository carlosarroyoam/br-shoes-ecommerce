<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductPropertyStoreRequest;
use App\Http\Requests\Products\ProductPropertyUpdateRequest;
use App\ProductProperty;
use Illuminate\Http\Request;

class ProductPropertyController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productProperties = ProductProperty::all();

        return view('productProperty.index', compact('productProperties'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('productProperty.create');
    }

    /**
     * @param \App\Http\Requests\Products\ProductPropertyStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductPropertyStoreRequest $request)
    {
        $productProperty = ProductProperty::create($request->validated());

        $request->session()->flash('productProperty.id', $productProperty->id);

        return redirect()->route('productProperty.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\ProductProperty $productProperty
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ProductProperty $productProperty)
    {
        return view('productProperty.show', compact('productProperty'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\ProductProperty $productProperty
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ProductProperty $productProperty)
    {
        return view('productProperty.edit', compact('productProperty'));
    }

    /**
     * @param \App\Http\Requests\Products\ProductPropertyUpdateRequest $request
     * @param \App\ProductProperty $productProperty
     * @return \Illuminate\Http\Response
     */
    public function update(ProductPropertyUpdateRequest $request, ProductProperty $productProperty)
    {
        $productProperty->update($request->validated());

        $request->session()->flash('productProperty.id', $productProperty->id);

        return redirect()->route('productProperty.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\ProductProperty $productProperty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ProductProperty $productProperty)
    {
        $productProperty->delete();

        return redirect()->route('productProperty.index');
    }
}
