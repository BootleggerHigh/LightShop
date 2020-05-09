@extends('layouts.app',['title'=>'Оформление заказа'])
@section('content')
    <h1>@lang('order.order_number'): #{{$order->id}}</h1>
    <p>@lang('basket.total_cost'): <b>{{$order->getAllCostProduct()}} {{App\Services\Classes\CurrencyCode::getCodeCurrency()}}</b></p>
    @guest()
    <td> <b>@lang('order.info_register')</b></td>
    @endguest
    @include('shop.include.layouts.order.basket-info',compact('order'))
    @include('shop.include.layouts.errors.errors')
    <form action="{{route('basket.store',$order->id)}}" method="POST">
        @csrf
    @include('shop.include.layouts.order.order-layouts')
        <button class="btn btn-outline-success" type="submit">@lang('button.confirm_order')</button>
    </form>
@endsection
