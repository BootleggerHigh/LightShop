<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrder;
use App\Models\Order;

define("SESSION_KEY_ORDER", 'orderId');

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $order = Order::checkOrderOrCreateOrderAndSessionOrGetOrder(SESSION_KEY_ORDER, true);
        return view('shop.basket.basket', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateOrder $request)
    {
        $order = Order::checkOrderOrCreateOrderAndSessionOrGetOrder(SESSION_KEY_ORDER);

        if (Order::saveOrder($request, $order, SESSION_KEY_ORDER)) {

            return redirect(route('product.index'))->with('success',
                __('order.order_number').' # ' . $order->id .','.  __('flash.info_success_order'));
        } else {
            return redirect(route('product.index'))->with('failed',
                __('flash.error_order'). $order->id . __('flash.info_error_order'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::checkOrderOrCreateOrderAndSessionOrGetOrder(SESSION_KEY_ORDER);
        return view('shop.order.order', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $productId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($productId)
    {
        $result = Order::checkOrCreateSessionOrModelAndSetModelAndCountProducts(SESSION_KEY_ORDER, $productId, true);
        $name_product = Order::getNameProductInOrder($productId, SESSION_KEY_ORDER);
        if ($result) {
            return back()->with('success', __('flash.product') . $name_product . __('flash.add_to_cart_product') );
        }
        return back()->with('failed', __('flash.product') . $name_product . __('flash.info_failed_add_to_cart_product'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $name_product = Order::getNameProductInOrder($id, SESSION_KEY_ORDER);
        $result = Order::checkOrCreateSessionOrModelAndSetModelAndCountProducts(SESSION_KEY_ORDER, $id, false);
        if ($result) {
            return back()->with('success', $name_product . __('flash.delete_to_cart_product'));
        }
        return back()->with('failed', __('flash.product') . $name_product . __('flash.info_failed_delete_to_cart_product'));
    }
}
