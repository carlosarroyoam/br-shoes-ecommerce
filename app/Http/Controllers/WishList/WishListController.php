<?php

namespace App\Http\Controllers\WishList;

use App\Http\Controllers\Controller;
use App\Http\Requests\WishList\WishListStoreRequest;
use App\Http\Requests\WishList\WishListUpdateRequest;
use App\WishList;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    /**
     * @param \App\Http\Requests\WishList\WishListStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(WishListStoreRequest $request)
    {
        $wishList = WishList::create($request->validated());

        $request->session()->flash('wishList.id', $wishList->id);

        return redirect()->route('wishList.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\WishList $wishList
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, WishList $wishList)
    {
        return view('wishList.show', compact('wishList'));
    }

    /**
     * @param \App\Http\Requests\WishList\WishListUpdateRequest $request
     * @param \App\WishList $wishList
     * @return \Illuminate\Http\Response
     */
    public function update(WishListUpdateRequest $request, WishList $wishList)
    {
        $wishList->update($request->validated());

        $request->session()->flash('wishList.id', $wishList->id);

        return redirect()->route('wishList.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\WishList $wishList
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, WishList $wishList)
    {
        $wishList->delete();

        return redirect()->route('wishList.index');
    }
}
