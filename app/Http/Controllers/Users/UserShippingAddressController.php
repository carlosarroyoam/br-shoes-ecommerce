<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserShippingAddressStoreRequest;
use App\Http\Requests\Users\UserShippingAddressUpdateRequest;
use App\UserShippingAddress;
use Illuminate\Http\Request;

class UserShippingAddressController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userShippingAddresses = UserShippingAddress::all();

        return view('userShippingAddress.index', compact('userShippingAddresses'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('userShippingAddress.create');
    }

    /**
     * @param \App\Http\Requests\Users\UserShippingAddressStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserShippingAddressStoreRequest $request)
    {
        $userShippingAddress = UserShippingAddress::create($request->validated());

        $request->session()->flash('userShippingAddress.id', $userShippingAddress->id);

        return redirect()->route('userShippingAddress.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\UserShippingAddress $userShippingAddress
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, UserShippingAddress $userShippingAddress)
    {
        return view('userShippingAddress.show', compact('userShippingAddress'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\UserShippingAddress $userShippingAddress
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, UserShippingAddress $userShippingAddress)
    {
        return view('userShippingAddress.edit', compact('userShippingAddress'));
    }

    /**
     * @param \App\Http\Requests\Users\UserShippingAddressUpdateRequest $request
     * @param \App\UserShippingAddress $userShippingAddress
     * @return \Illuminate\Http\Response
     */
    public function update(UserShippingAddressUpdateRequest $request, UserShippingAddress $userShippingAddress)
    {
        $userShippingAddress->update($request->validated());

        $request->session()->flash('userShippingAddress.id', $userShippingAddress->id);

        return redirect()->route('userShippingAddress.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\UserShippingAddress $userShippingAddress
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, UserShippingAddress $userShippingAddress)
    {
        $userShippingAddress->delete();

        return redirect()->route('userShippingAddress.index');
    }
}
