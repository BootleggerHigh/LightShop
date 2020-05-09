@extends('layouts.app',['title'=>'Администратор | Просмотр заказа'])
@section('content')
    <h1>Номер заказа: #{{$order->id}}</h1>
    <p>Общая стоимость: <b>{{$order->getAllCostProduct()}} {{App\Services\Classes\CurrencyCode::getCodeCurrency()}}</b></p>
    @include('shop.include.layouts.order.basket-info',compact('order','status'))
    @include('shop.include.layouts.errors.errors')
    @include('shop.include.layouts.order.order-layouts',compact('order','status'))
@endsection
