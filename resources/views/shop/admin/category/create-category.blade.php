@extends('layouts.app',['title'=>'Администратор | Создания каталога'])
@section('content')
    <h1 class="header-text">Создания каталога</h1>
    @include('shop.include.layouts.errors.errors')
    <form action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
    @include('shop.include.layouts.category.create')
        <button class="btn btn-outline-success" type="submit">Создать</button>
    </form>
@endsection
