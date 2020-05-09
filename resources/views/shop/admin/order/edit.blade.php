@extends('layouts.app',['title'=>'Администратор | Действия с  заказом'])
@section('content')
    <h1>Номер заказа: #{{$order->id}}</h1>
    <p>Общая стоимость: <b>{{$order->getAllCostProduct()}} {{App\Services\Classes\CurrencyCode::getCodeCurrency()}}</b></p>
    <a class="btn btn-outline-success" href="{{route('admin.order.index')}}">Перейти в заказы</a>
    @include('shop.include.layouts.order.basket-info',compact('order','status'))
    @include('shop.include.layouts.errors.errors')
    <form action="{{route('admin.order.update',$order->id)}}" method="POST">
        @csrf
        @method('PATCH')
        @include('shop.include.layouts.order.order-layouts',compact('order','status'))
        <button class="btn btn-outline-success" type="submit">Изменить заказ</button>
    </form>
@endsection
