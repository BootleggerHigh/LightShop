@extends('layouts.app',['title'=>'Администратор | Создания каталога'])
@section('content')
    <h1 class="header-text">Изменения каталога</h1>
    @include('shop.include.layouts.errors.errors')
    <form action="{{route('admin.category.update',$category)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        @include('shop.include.layouts.category.create',$category)
        <button class="btn btn-outline-dark" type="submit">Обновить категорию</button>
    </form>
@endsection
