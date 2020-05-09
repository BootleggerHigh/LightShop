<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrder;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $orders = Order::with('products')->simplePaginate(9);
        return view('shop.admin.order.order-index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::checkOrderOrCreateOrderAndSessionOrGetOrder($id);
        $status = 1;
        return view('shop.admin.order.edit', compact('order', 'status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::checkOrderOrCreateOrderAndSessionOrGetOrder($id);
        $status = 0;
        return view('shop.admin.order.edit', compact('order', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CreateOrder $request, $id)
    {
        $order =  Order::checkOrderOrCreateOrderAndSessionOrGetOrder($id);
       if(request()->get('status') === '1')
       {
           $order->count_reserve_products_decrement;
       }
        if ($request->has('product_id') && $request->has('increment')) {
            Order::adminEditOrder($id, $request->get('product_id'), $request->get('increment'));
        }
        $order->update($request->all());

        return back()->with('success', 'Заказ №' . $id . ' обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orders = Order::find($id);
        $orders->count_products_increment;
        $orders->count_reserve_products_decrement;
        Order::destroy($orders->id);
        return back()->with('success', 'Заказ №' . $orders->id. ' удален');
    }
}
