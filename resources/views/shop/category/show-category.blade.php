@extends('layouts.app')
@section('content')
    <div class="starter-template">
        @foreach($categories as $category)
        <h1>
            {{$category->__localization('name')}}
        </h1>
        <p>
            {{$category->__localization('description')}}
        </p>
    </div>
@endforeach
    @include('shop.products.card',['products'=>$category->products])
    @endsection
