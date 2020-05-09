@extends('layouts.app',['title'=>'Пользователь | Просмотр заказа'])
@section('content')
    <h1>@lang('order.order_number'): #{{$order->id}}</h1>
    <p>@lang('basket.total_cost'): <b>{{$order->getAllCostProduct()}} {{App\Services\Classes\CurrencyCode::getCodeCurrency()}}</b></p>
    @include('shop.include.layouts.order.basket-info',compact('order','status'))
    @include('shop.include.layouts.errors.errors')
    @include('shop.include.layouts.order.order-layouts',compact('order','status'))
@endsection
