@extends('layouts.app',['title'=>$product->__localization('name')])
@section('content')
    @include('shop.include.layouts.errors.errors')
    <div class="starter-template">
        <h1>{{$product->__localization('name')}}</h1>
        <h2>{{$product->category->name}}</h2>
        @include('shop.include.layouts.tag.tag',compact('product'))
        <p>@lang('product.price') <b>{{$product->price}} {{App\Services\Classes\CurrencyCode::getCodeCurrency()}}</b></p>
        <img src="{{Storage::url($product->image)}}" alt="{{$product->__localization('name')}}">

        <p>{{$product->__localization('description')}}</p>
        @if ($product->IsAvailable())
            <form action="{{route('basket.edit',$product)}}" method="GET">
                <button type="submit" class="btn btn-outline-success" role="button">@lang('button.in_garbage')</button>
            </form>
        @else
            <p>@lang('product.product_not_available')</p>
            <b>@lang('product.notify') {{$product->__localization('name')}} :3</b>
            <form action="{{route('subscribe.store')}}"  method="POST">
                @csrf
                <input type="email" placeholder=@lang('product.input_email') name="email" value="{{old('email')}}">
                <input type="hidden"  name="product_id" value={{$product->id}}>
                <button type="submit" class="btn btn-outline-success">@lang('button.notify')</button>
            </form>
        @endif
        @can('admin')
            <a href="{{route('admin.product.edit',$product->id)}}" class="btn btn-outline-dark"
               role="button">Изменить</a>
            <form action="{{route('admin.product.destroy',$product)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger">Удалить</button>
            </form>
        @endcan
    </div>
@endsection
