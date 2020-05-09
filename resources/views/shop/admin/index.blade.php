@extends('layouts.app',['title'=>'Администратор | Главная страница'])
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12"><h1 class="header-text">Фичи Админки</h1>
                <table class="table">
                    <thead>
                    <tr>
                        <td>Наименование фичи</td>
                        <td>Фича вывозит в Rest?</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                           <a href="{{route('admin.order.index')}}">Заказы</a>
                        </td>
                        <td>
                            Так точно!
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{route('admin.category.index')}}">Категории</a>
                        </td>
                        <td>
                            Так точно!
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{route('admin.product.index')}}">Продукты</a>
                        </td>
                        <td>
                            Так точно!
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <p>Gate защищает панельку от обычных юзеров :3</p>
    </div>
    @endsection
