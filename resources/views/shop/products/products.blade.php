@extends('layouts.app',['title'=>'Все товары'])
@section('content')
    @include('shop.include.layouts.errors.errors')
    <div class="starter-template">
        @can('admin')
            <div class="float-right">
                <a  class="btn btn-outline-success" href="{{route('admin.product.create')}}">Создать новый товар</a>
            </div>
        @endcan
        @if(!empty($products->first()))
        <h1>@lang('nav.products')</h1>
        @include('shop.products.card',compact('products'))
            @else
        <h1>@lang('filter.not_found')</h1>
            @endif
    </div>
    {{$products->links()}}
@endsection
