<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        return redirect(route('category.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('shop.admin.category.create-category');
    }
    public function store(CreateCategory $request)
    {
        $path = $request->file('image')->store('categories');
        $params = $request->all();
        $params['image'] = $path;
        Category::create($params);
        return redirect(route('category.index'))->with('success', 'Категория успешно создана');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('shop.admin.category.edit-category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCategory $request, $id)
    {
        $category = Category::find($id);
        if ($request->has('image')) {
            $path = $request->file('image')->store('categories');
            $params = $request->all();
            $params['image'] = $path;
            if ($request->file('image')->store('categories') !== $category->image) {
                Storage::delete($category->image);
                $category->update($params);
            } else {
                $category->update($request->all());
            }
        } else {
            $category->update($request->all());
        }
        return redirect(route('category.index'))->with('success', 'Категория обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect(route('category.index'))->with('success', 'Категория удалена');
    }
}
