<div class="container">
    <div class="row justify-content-center">
        <div class="container">
            @isset($status)
                <p>@lang('order.data_info')</p>
                @else
                <p>@lang('order.contact_info')</p>
                @endif
            <div class="form-inline">
                <label for="name" class="control-label col-lg-offset-3 col-lg-2">@lang('order.name') </label>
                <div class="col-lg-4">
                    <input type="text" name="name" @can('admin') {{!empty($status)?? !$status ? 'disabled' : ''}} @endcan id="name"
                           value="{{old('name')??$order->name}}"
                           class="form-control">
                </div>
            </div>
            <br>
            <br>
            <div class="form-inline">
                <label for="phone" class="control-label col-lg-offset-3 col-lg-2">@lang('order.number') </label>
                <div class="col-lg-4">
                    <input type="text" @can('admin') {{!empty($status)?? !$status ? 'disabled' : ''}} @endcan name="phone" id="phone"
                           value="{{old('phone')??$order->phone}}" class="form-control">
                </div>
            </div>
            <br>
            <br>
            <div class="form-inline">
                <label for="name" class="control-label col-lg-offset-3 col-lg-2">@lang('order.email') </label>
                <div class="col-lg-4">
                    <input type="text" @can('admin') {{!empty($status) ?? !$status ? 'disabled' : ''}} @endcan name="email" id="email"
                           value="{{old('email') ??$order->email}}"
                           class="form-control">
                </div>
            </div>
            <br>
            <br>
            @can('admin')
                @if(isset($status))
                    @if(!$status)
                <div class="form-inline">
                    <label for="status" class="control-label col-lg-offset-3 col-lg-2">Действия с заказом :</label>
                    <div class="col-lg-4">
                        <select class="form-control" name="status" id="status" required="required">
                            <option name="status" value="{{$order->status ? '1':'0'}}">
                                {{$order->status ? 'Подтвердить отправку заказа':'Отменить подтверждения отправки заказа'}}
                            </option>
                            <option name="status" value="{{!$order->status ? '1':'0'}}">
                                {{!$order->status ? 'Подтвердить отправку заказа':'Отменить подтверждения отправки заказа'}}
                            </option>
                        </select>
                    </div>
                </div>
                        @endif
                    @endif
            @endcan
            <br>
        </div>
    </div>
</div>
