@extends('layouts.app',['title'=>'Администратор | Создания продукта'])
@section('content')
    <h1 class="header-text">Создания продукта</h1>
    @include('shop.include.layouts.errors.errors')
    <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('shop.include.layouts.products.create',$all_category)
        <button class="btn btn-outline-success" type="submit">Создать</button>
    </form>
@endsection
