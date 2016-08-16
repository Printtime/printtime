<!DOCTYPE html>
<html lang="{{ config()['app']['locale'] }}">

@include('layouts.head')

<body id="app-layout">

@include('layouts.header')

    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/images/logo.png" alt="Printtime">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li{{ Helper::setActive('/') }}><a href="{{ url('/') }}">Услуги</a></li>
                    <li{{ Helper::setActive('post') }}><a title="Новости" href="{!! route('post.index') !!}">Новости</a></li>
                    <li{{ Helper::setActive('portfolio') }}><a href="{!! route('catalog.portfolio') !!}">Наши работы</a></li>
                    <li{{ Helper::setActive('page/2') }}><a href="{{ url('/page/2') }}">Контакты</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
               {{-- <ul class="nav navbar-nav navbar-right">
                    @include('auth.partials.navbar')
                </ul>
                --}}
                <ul class="nav navbar-nav navbar-right">

            @if((Auth::check()))

                   {{-- <li @if (Request::is('profile*')) class="active" @endif>
                        <a href="/profile"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{ Auth::user()->name }}</a>
                    </li> --}}

<li{{ Helper::setActive('user/transfer') }}><a href="{!! route('user.transfer') !!}" class="ajax-pay" data-toggle="modal" data-target="#open-modal-pay"><span class="glyphicon glyphicon-transfer"></span> {{ Auth::user()->balance }} грн.</a></li>


                    <li>
                        <a href="/logout"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Выход</a>
                    </li>

                @else
                    <li{{ Helper::setActive('register') }}>
                        <a href="/register"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Регистрация</a>
                    </li>
                    <li{{ Helper::setActive('login') }}>
                        <a href="/login"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Вход</a>
                    </li>
                @endif

                </ul>
            </div>
        </div>
    </nav>

@if(!(Auth::check()))
    @if($slider and !Request::is('register') and !Request::is('login') and !Request::is('password') and !Request::is('user*'))
        @include('slider.index')
    @endif
@endif

   <div class="body @foreach (explode('.', Request::route()->getName()) as $post) {{ $post }} @endforeach">

@if((Auth::check()))
   @include('user.nav')
@endif


@if (count($errors) > 0)
<div class="container">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
    </div>
</div>
@endif

            @if(Request::is('catalog/*'))
                <div class="container">
                      <div class="row">
                        @include('layouts.menu')
                        @yield('catalog')
                    </div>
                </div>
            @endif

        @yield('content')
        @yield('page')
    </div>

<hr>

    @include('layouts.footer')

</body>
</html>
