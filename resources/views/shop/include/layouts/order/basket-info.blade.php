<div class="panel">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>@lang('basket.title_product')</th>
            <th>@lang('basket.count')</th>
            <th>@lang('basket.price')</th>
            <th>@lang('basket.cost')</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            @foreach($order->products as $product)
                <td>
                    <a href="{{route('product.show',$product->code)}}">
                        <img height="56px" src="{{Storage::url($product->image)}}" alt="{{$product->name}}">
                        {{$product->name}}
                    </a>
                    @include('shop.include.layouts.tag.tag',compact('product'))
                </td>
                <td><span class="badge">{{$product->pivot->count}}</span>
                    <div class="btn-group">
                        @if(isset($status))
                            @if(!$status)
                                @if(!$order->status)
                                    @can('admin')
                                        <form action="{{route('admin.order.update',$order)}}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-success"  {{$product->setCountProductAndReserveCountProduct()}}  type="submit" name="increment"
                                                    value={{true}}>+
                                            </button>
                                            <button class="btn btn-danger"   type="submit" name="decrement"
                                                    value={{false}}>-
                                            </button>
                                        </form>
                                    @endcan()
                    </div>
                </td>
                @endif
                @endif
                @else
                    @if(!request()->is('basket/*'))
                    <form action="{{route('basket.edit',$product)}}" method="GET">
                        @csrf
                        <button class="btn btn-success" {{$product->setCountProductAndReserveCountProduct()}}  type="submit" name="increment"
                                value={{true}}>+
                        </button>
                    </form>
                    <form action="{{route('basket.destroy',$product)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit"   class="btn btn-danger">-</button>
                    </form>
                    @endif
                @endif
                <td>{{$product->price}} {{App\Services\Classes\CurrencyCode::getCodeCurrency()}}</td>
                <td>{{$product->getAllSumProduct()}} {{App\Services\Classes\CurrencyCode::getCodeCurrency()}}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="3">@lang('basket.total_cost')</td>
            <td>{{$order->getAllCostProduct()}} {{App\Services\Classes\CurrencyCode::getCodeCurrency()}}</td>
        </tr>
        </tbody>
    </table>
    <br>
</div>
