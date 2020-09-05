<?php

namespace App\Http\Controllers\Orders;

use App\OrderDetail;
use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderDetails\OrderDetailStoreRequest;
use App\Http\Requests\Orders\OrderDetails\OrderDetailUpdateRequest;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orderDetails = OrderDetail::all();

        return view('pages.orders.order-details.index', compact('orderDetails'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('pages.orders.order-details.create');
    }

    /**
     * @param \App\Http\Requests\Orders\OrderDetailStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderDetailStoreRequest $request)
    {
        $orderDetail = OrderDetail::create($request->validated());

        $request->session()->flash('orderDetail.id', $orderDetail->id);

        return redirect()->route('order-details.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\OrderDetail $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, OrderDetail $orderDetail)
    {
        return view('pages.orders.order-details.show', compact('orderDetail'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\OrderDetail $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, OrderDetail $orderDetail)
    {
        return view('pages.orders.order-details.edit', compact('orderDetail'));
    }

    /**
     * @param \App\Http\Requests\Orders\OrderDetailUpdateRequest $request
     * @param \App\OrderDetail $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function update(OrderDetailUpdateRequest $request, OrderDetail $orderDetail)
    {
        $orderDetail->update($request->validated());

        $request->session()->flash('orderDetail.id', $orderDetail->id);

        return redirect()->route('order-details.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\OrderDetail $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, OrderDetail $orderDetail)
    {
        $orderDetail->delete();

        return redirect()->route('order-details.index');
    }
}
