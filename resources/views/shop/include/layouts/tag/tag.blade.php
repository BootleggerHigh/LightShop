@if($product->isNew())
    <span class="badge badge-success">@lang('nav.filter.new')</span>
@endif

@if($product->isRecommend())
    <span class="badge badge-warning">@lang('nav.filter.recommend')</span>
@endif

@if($product->isHit())
    <span class="badge badge-danger">@lang('nav.filter.hit')</span>
@endif
