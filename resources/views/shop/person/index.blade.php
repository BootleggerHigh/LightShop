@extends('layouts.app',['title'=>'Мои заказы'])
@include('shop.include.layouts.flash.warning')
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12">
                <div class="float-left">
                    <a class="btn btn-outline-success" href="{{route('person.basket.create')}}">
                        @lang('profile.create_order')
                    </a>
                </div>
                <h1 class="header-text">@lang('nav.my_orders')</h1>
                <h4 class="header-text">
                    @lang('profile.info')
                </h4>
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            @lang('order.order_number')
                        </th>
                        <th>
                            @lang('order.name')
                        </th>
                        <th>
                            @lang('order.number')
                        </th>
                        <th>
                            @lang('profile.order_status')
                        </th>
                        <th>
                            @lang('profile.order_data_create')
                        </th>
                        <th>
                            @lang('order.email')
                        </th>
                        <td>
                            @lang('basket.total_cost')
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>
                                {{$order->id}}
                            </td>
                            <td>
                                {{$order->name}}
                            </td>
                            <td>
                                {{$order->phone}}
                            </td>
                            <td>
                                {{$order->status ? __('order.accepted') : __('order.in_processing')}}
                            </td>
                            <td>
                                {{$order->created_at}}
                            </td>
                            <td>{{$order->email}}</td>
                            <td>{{$order->getAllCostProduct()}} {{App\Services\Classes\CurrencyCode::getCodeCurrency()}} </td>
                            <td>
                                @if(!$order->status)
                                    <a class="btn btn-warning" href="{{route('person.basket.edit',$order)}}">
                                        @lang('button.change_contact_data')
                                    </a>

                                <form action="{{route('person.basket.destroy',$order)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">@lang('button.delete_order')</button>
                                </form>

                                @endif
                                <a class="btn btn-outline-success" href="{{route('person.basket.show',$order)}}">
                                    @lang('button.show_order')
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
