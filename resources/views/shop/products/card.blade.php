<div class="row">
    @foreach($products as $product)
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <div class="labels">
                </div>
                <img src="{{Storage::url($product->image)}}" alt="{{$product->__localization('name')}}">
                <div class="caption">
                    <h3>{{$product->__localization('name')}}</h3>
                    <p> @include('shop.include.layouts.tag.tag',compact('product')) {{$product->price}} {{App\Services\Classes\CurrencyCode::getCodeCurrency()}}</p>
                    <p> @lang('product.count_product') {{$product->product_count}} </p>
                    <p>@lang('product.reserved') {{$product->product_count_reserve}}</p>
                    @if ($product->IsAvailable())
                        <form action="{{route('basket.edit',$product)}}" method="GET">
                            <button type="submit"  class="btn btn-outline-success" role="button">@lang('button.in_garbage')</button>
                        </form>
                    @else
                        <p>@lang('product.product_not_available')</p>
                    @endif
                    <a href="{{route('product.show',$product->code)}}" class="btn btn-outline-primary"
                       role="button">@lang('button.more_details')</a>
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
            </div>
        </div>
    @endforeach
</div>



