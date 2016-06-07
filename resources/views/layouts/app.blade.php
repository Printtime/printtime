<!DOCTYPE html>
<html lang="{{ config()['app']['locale'] }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Printtime</title>
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<body id="app-layout">

<div class="top-container">
    <div class="container">
            <div class="col-md-12 top-contacts hidden-sm hidden-xs">Звоните сейчас! <i class="icon logo-icon"></i> (050) 856 67 63 <i class="icon logo-icon"></i> (067) 812-81-11 <i class="icon logo-icon"></i> (067) 812-81-11 
                    <a href="{{ url('/home') }}" class="top-contacts-circle-text"><sup class="fa fa-clock-o" aria-hidden="true"></sup> 9:00-18:00 <sup>пн-сб</sup></a>
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
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    @include('auth.partials.navbar')
                </ul>
            </div>
        </div>
    </nav>

    @if($slider)
        @include('slider.index')
    @endif

   <div class="body">@yield('content')</div>

<footer class="footer">
      <div class="container">
        <div class="col-md-4">
        @foreach ($footer as $catalog)
            <h3>{!! $catalog->title !!}</h3>
            @foreach ($catalog->products as $product)
                {!! $product->title !!}<br>
            @endforeach
        @endforeach
        </div>
        <div class="col-md-4">
        <h3>Footer 2</h3>
            <p>Content footer 1, Content footer 1 Content footer 1 Content footer 1, Content footer 1 Content footer 1 Content footer 1, Content footer 1 Content footer 1 Content footer 1, Content footer 1 Content footer 1Content footer 1, Content footer 1 Content footer 1 Content footer 1, Content footer 1 Content footer 1</p>
        </div>

        <div class="col-md-4">
        <h3>Footer 3</h3>
            <p>Content footer 1, Content footer 1 Content footer 1 Content footer 1, Content footer 1 Content footer 1 Content footer 1, Content footer 1 Content footer 1 Content footer 1, Content footer 1 Content footer 1Content footer 1, Content footer 1 Content footer 1 Content footer 1, Content footer 1 Content footer 1</p>
        </div>
      </div>
</footer>


    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
