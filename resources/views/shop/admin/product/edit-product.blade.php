@extends('layouts.app',['title'=>'Администратор | Изменения продукта'])
@section('content')
    <h1 class="header-text">Изменения продукта <b>{{$product->name}}</b></h1>
    @include('shop.include.layouts.errors.errors')
    <form action="{{route('admin.product.update',$product)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        @include('shop.include.layouts.products.create',[$product,$all_category])
        <button class="btn btn-outline-success" type="submit">Изменить</button>
    </form>
@endsection
