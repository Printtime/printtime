<!DOCTYPE html>
<html lang="{{ config()['app']['locale'] }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Printtime</title>
    <link href="{{ elixir('css/all.css') }}" rel="stylesheet">
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    <base href="/">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>



<body id="app-layout">

<div class="top-container">
    <div class="container">
            <div class="col-md-12 top-contacts hidden-sm hidden-xs">Звоните сейчас! <i class="icon logo-icon"></i> (050) 856 67 63 <i class="icon logo-icon"></i> (096) 873 33 15 <i class="icon logo-icon"></i> (063) 812 81 81 
                    <a href="{{ url('/page/2') }}" class="top-contacts-circle-text"><sup class="fa fa-clock-o" aria-hidden="true"></sup> 9:00-18:00 <sup>пн-сб</sup></a>
                    <div class="top-contacts-circle"></div>
        </div>
    </div>
</div>

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
                </ul>

                <!-- Right Side Of Navbar -->
               {{-- <ul class="nav navbar-nav navbar-right">
                    @include('auth.partials.navbar')
                </ul>
                --}}
                <ul class="nav navbar-nav navbar-right">
                    <li{{ Helper::setActive('page/2') }}><a href="{{ url('/page/2') }}">Контакты</a></li>
                </ul>
            </div>
        </div>
    </nav>

    @if($slider)
        @include('slider.index')
    @endif



   <div class="body @foreach (explode('.', Request::route()->getName()) as $post) {{ $post }} @endforeach">
        @yield('page')
        @yield('content')
    </div>


    @include('layouts.footer')

<a id="back-to-top" href="#" class="btn btn-lg back-to-top" role="button" title="Наверх!" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>

<div class="modal fade" id="open-modal" tabindex="-1" role="dialog"><div class="modal-dialog" role="document"></div></div>


    <!-- JavaScripts -->
<!--     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="/js/wow.min.js"></script>
    <script src="/js/js.js"></script> -->
    
    <script src="{{ elixir('js/app.js') }}"></script>
</body>
</html>
