@extends('layouts.app',['title'=>__('basket.title_header')])
@section('content')
<div id="app">
    <div class="starter-template">
        @if((session()->get('count')))
        <h1>@lang('basket.title_header')</h1>
        @include('shop.include.layouts.order.basket-info',compact('order'))
            <div class="btn-group pull-right" role="group">
                <a type="button" class="btn btn-success" href="{{route('basket.show',$order->id)}}">@lang('button.checkout')</a>
            </div>
        </div>
        @else
            <p>@lang('basket.cart_empty'):(</p>
        @endif
    </div>
    @endsection
