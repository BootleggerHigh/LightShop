<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::simplePaginate(9);
        return view('shop.products.products', compact('products'));
    }


    public function show($code)
    {
        $product = Product::where('code', $code)->with('category')->first();
        return view('shop.products.show-product', compact('product'));
    }
}
