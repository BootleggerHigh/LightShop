<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>'set_locate'],function()
{
    Route::resource('product', 'ProductController')->only('index','show');
    Route::resource('category', 'CategoryController')->only('index','show');
    Route::resource('basket','BasketController')->except('update','create');
    Route::resource('filter','Filter\FilterTagAndPrice');
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
});


Route::get('change_locate/{locale}',function ($locale)
{
    $array_language = ['ru','en'];
    if(in_array($locale,$array_language))
    {
        session(['locale'=>$locale]);
    }

    return back();
})->name('change_language');


Route::group(['middleware'=>['auth','check_in_order','set_locate','check_person'],'prefix'=>'person','name'=>'person.','namespace'=>'Person','as'=>'person.'],function ()
{
   Route::resource('basket','PersonController');
});

Route::resource('subscribe','SubscriptionController')->only('store');
Route::resource('currency','CurrencyController');


Route::group(['middleware' => ['can:admin','set_locate'],'prefix' => 'admin','name'=>'admin.','namespace' => 'Admin','as' => 'admin.'],function()
{
    Route::resource('admin','AdminController')->only('index');
    Route::resource('order','AdminOrderController')->except('create','store')->middleware('check_in_order');
    Route::resource('category','AdminCategoryController')->except('show');
    Route::resource('product','AdminProductController')->except('show');
});
