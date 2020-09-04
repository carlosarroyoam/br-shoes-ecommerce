<?php

namespace App\Http\Controllers\ShoppingBag;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShoppingBag\ShoppingBagStoreRequest;
use App\Http\Requests\ShoppingBag\ShoppingBagUpdateRequest;
use App\ShoppingBag;
use Illuminate\Http\Request;

class ShoppingBagController extends Controller
{
    /**
     * @param \App\Http\Requests\ShoppingBag\ShoppingBagStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShoppingBagStoreRequest $request)
    {
        $shoppingBag = ShoppingBag::create($request->validated());

        $request->session()->flash('shoppingBag.id', $shoppingBag->id);

        return redirect()->route('shoppingBag.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\ShoppingBag $shoppingBag
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ShoppingBag $shoppingBag)
    {
        return view('shoppingBag.show', compact('shoppingBag'));
    }

    /**
     * @param \App\Http\Requests\ShoppingBag\ShoppingBagUpdateRequest $request
     * @param \App\ShoppingBag $shoppingBag
     * @return \Illuminate\Http\Response
     */
    public function update(ShoppingBagUpdateRequest $request, ShoppingBag $shoppingBag)
    {
        $shoppingBag->update($request->validated());

        $request->session()->flash('shoppingBag.id', $shoppingBag->id);

        return redirect()->route('shoppingBag.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\ShoppingBag $shoppingBag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ShoppingBag $shoppingBag)
    {
        $shoppingBag->delete();

        return redirect()->route('shoppingBag.index');
    }
}
