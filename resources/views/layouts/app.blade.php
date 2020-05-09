<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('shop.include.head',['title'=>$title ?? 'Главная страница'])
@if(session('success'))
    @include('shop.include.layouts.flash.success',['session'=>session('success')])
@elseif(session('failed'))
    @include('shop.include.layouts.flash.failed',['session'=>session('failed')])
@endif
<body>
@include('shop.include.nav',['count'=>session()->get('count') ?? 0])
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
