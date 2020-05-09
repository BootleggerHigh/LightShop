@extends('layouts.app',['title'=>'Пользователь | Изменения заказа'])
@section('content')
    <h1>@lang('order.order_number'): #{{$order->id}}</h1>
    <p>@lang('basket.total_cost'): <b>{{$order->getAllCostProduct()}} {{App\Services\Classes\CurrencyCode::getCodeCurrency()}}</b></p>
    @can('admin')
        <b>Если заказ сделан из под администратора,то дается возможность изменять не только контактные данные,
            но и сам заказ,из-за привилегий,данная побочка идёт только на администратора,на обычных пользователей не распространяется :3</b>
    @endcan
    @include('shop.include.layouts.order.basket-info',compact('order','status'))
    @include('shop.include.layouts.errors.errors')
    <form action="{{route('person.basket.update',$order->id)}}" method="POST">
        @csrf
        @method('PATCH')
        @include('shop.include.layouts.order.order-layouts',compact('order','status'))
        <button class="btn btn-outline-success" type="submit">Изменить заказ</button>
    </form>
@endsection
