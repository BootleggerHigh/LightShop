<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(route('product.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_category = Product::getCategory();
        return view('shop.admin.product.create-product', compact('all_category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProduct $request)
    {
        $path = $request->file('image')->store('products');
        $params = $request->all();
        $params['image'] = $path;
        Product::checkFilter($params);
        Product::create($params);
        return redirect(route('product.index'))->with('success', 'Продукт успешно создан');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $all_category = Product::getCategory();
        $product = Product::find($id);
        return view('shop.admin.product.edit-product', compact('all_category', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateProduct $request, $id)
    {
        $params = Product::checkFilter($request->all());
        $product = Product::find($id);
        if ($request->has('image')) {
            $path = $request->file('image')->store('products');
            $params['image'] = $path;
            if ($request->file('image')->store('products') !== $product->image) {
                Storage::delete($product->image);
                $product->update($params);
            } else {
                $product->update($params);
            }
        } else {
            $product->update($params);
        }
        return redirect(route('product.index'))->with('success', 'Продут обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect(route('product.index'))->with('success', 'Продукт удален');
    }
}
