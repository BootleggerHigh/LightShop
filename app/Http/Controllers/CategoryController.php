<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::all('id', 'name', 'description', 'code', 'image','name_en','description_en');

        return view('shop.category.categories',
            compact('categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($code)
    {
        $categories = Category::where('code', $code)->with('products')->get('id', 'name', 'description');
        return view('shop.category.show-category',
            compact('categories'));
    }
}
