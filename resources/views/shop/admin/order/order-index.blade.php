@extends('layouts.app',['title'=>'Администратор | Страница Заказов'])
@include('shop.include.layouts.flash.warning')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12"><h1 class="header-text">Заказы</h1>
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            Имя
                        </th>
                        <th>
                            Телефон
                        </th>
                        <th>
                            Когда отправлен
                        </th>
                        <th>
                            Сумма
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <th>
                                {{$order->id}}
                            </th>
                            <th>
                                {{$order->name}}
                            </th>
                            <th>
                                {{$order->phone}}
                            </th>
                            <th>
                                {{$order->status ? $order->updated_at : 'Заказ не отправлен'}}
                            </th>
                            <th>
                                {{$order->getAllCostProduct()}} {{App\Services\Classes\CurrencyCode::getCodeCurrency()}}
                            </th>
                            <th>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        Действие с заказом
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <form action="{{route('admin.order.destroy',$order)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item btn-outline-danger">Удалить заказ</button>
                                        </form>
                                        <a class="dropdown-item btn-outline-info"
                                           href="{{route('admin.order.edit',$order)}}">Изменить заказ или его статус</a>
                                        <a class="dropdown-item btn-outline-info" href="{{route('admin.order.show',$order)}}">
                                            Просмотреть заказ
                                        </a>
                                    </div>
                                </div>
                            </th>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
