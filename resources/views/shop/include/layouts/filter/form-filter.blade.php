<form method="GET" action="{{route('filter.show',true)}}">
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <div class="dropdown-item">
            <label for="price_from">@lang('nav.filter.price_from')<input type="text" name="price_from" id="price_from" size="6" placeholder="0"
                                                   value="{{old('price_form')??request()->price_from ??''}}">
            </label>
            <label for="price_to">@lang('nav.filter.price_to') <input type="text" name="price_to" id="price_to" size="6" placeholder="999999"
                                            value="{{old('price_to')??request()->price_to ??''}}">
            </label>
        </div>
        <div class="dropdown-item">
            <label for="hit">
                <input type="checkbox" name="is_hit" id="hit" @if(request()->has('is_hit')) checked @endif> @lang('nav.filter.hit') </label>
        </div>
        <div class="dropdown-item">
            <label for="new">
                <input type="checkbox" name="is_new" id="new" @if(request()->has('is_new')) checked @endif> @lang('nav.filter.new') </label>
        </div>
        <div class="dropdown-item">
            <label for="recommend">
                <input type="checkbox" name="is_recommend" id="recommend" @if(request()->has('is_recommend')) checked @endif> @lang('nav.filter.recommend') </label>
        </div>
        <div class="dropdown-item">
            <button type="submit" class="btn btn-primary">@lang('button.filter')</button>
            <a href="{{route('product.index')}}" class="btn btn-outline-danger">@lang('button.reset')</a>
        </div>
    </div>
</form>
