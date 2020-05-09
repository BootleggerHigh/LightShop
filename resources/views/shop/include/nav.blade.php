<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <a class="navbar-brand" href="{{route('product.index')}}">@lang('nav.name_shop')</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li @routeactive('product*')>
                        <a class="nav-link" href="{{route('product.index')}}">@lang('nav.products')</a>
                    </li>
                    <li @routeactive('category*')>
                        <a class="nav-link"  href="{{route('category.index')}}">@lang('nav.category')</a>
                    </li>
                    <li @routeactive('basket*')>
                        <a class="nav-link"  href="{{route('basket.index')}}">@lang('nav.basket') <sup class="btn-outline-success">{{$count??0}}</sup></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('nav.language')</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <a class="dropdown-item" href="{{route('change_language',"ru")}}">Русский @if(App::getLocale() === 'ru') <-(@lang('nav.current_language')) @endif</a>
                            <a class="dropdown-item" href="{{route('change_language',"en")}}">English @if(App::getLocale() === 'en') <-(@lang('nav.current_language')) @endif</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('nav.currency')</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <a class="dropdown-item" href="{{route('currency.edit',1)}}">$</a>
                            <a class="dropdown-item"  href="{{route('currency.edit',2)}}">€</a>
                            <a class="dropdown-item" href="{{route('currency.edit',3)}}">₽</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('nav.filter.name')</a>
                    @include('shop.include.layouts.filter.form-filter')
                    </li>
                </ul>
            </div>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">@lang('nav.login')</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">@lang('nav.register')</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('person.basket.index') }}">
                                {{ __('nav.my_orders') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                     onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                @lang('nav.logout')
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
                @can('admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{__('Панель управления')}}</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <a class="dropdown-item" href="{{route('admin.admin.index')}}">Главная страница</a>
                            <a class="dropdown-item" href="{{route('admin.order.index')}}">Заказы</a>
                            <a class="dropdown-item" href="{{route('admin.category.index')}}">Категории</a>
                            <a class="dropdown-item" href="{{route('admin.product.index')}}">Продукты</a>
                        </div>
                    </li>
                @endcan
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder=@lang('nav.search_products') aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">@lang('button.search')</button>
            </form>

        </div>
    </div>
</nav>
