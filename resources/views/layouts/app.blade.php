<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    {{-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> --}}


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.6/styles/hybrid.min.css">
    <style>
        img{
            border-radius: 50%;
        }
        a:link{
            text-decoration: none!important;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if(Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" alt=" " style="border-radius: 50%; height: 30px;">
                                @endif
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <div class="container-fluid">
<div class="row">
@if (Auth::check())
    <div class="col-sm-3">
        <a href="{{ route('discussion.create') }}" class="btn btn-primary btn-block">Create Discussion</a>

        <br>


        <ul class="list-group">


        

        {{-- <li class="list-group-item">
        <a href="{{ route('channels.create') }}">Create Channel</a></li> --}}        

    @if(Auth::user()->admin)
        
    @endif

        <div class="card">
        <li class="list-group-item">
        <a href="/home">Home</a></li>

        <li class="list-group-item">
        <a href="{{ route('home',['filter'=>'me']) }}">My Discussions</a></li>

        <li class="list-group-item">
        <a href="{{ route('home',['filter'=>'opened']) }}">Opened Discussions</a></li> 

        <li class="list-group-item">
        <a href="/home?filter=closed">Closed Discussions</a></li>

{{--         <li class="list-group-item">
        <a href="{{ route('discussion.index') }}">Discussions</a></li> --}}

        </div>

        <br>

        <div class="card">

        <li class="list-group-item">
        <a href="{{ route('channels.index') }}">Channels</a></li>
        <div class="card-body">
        <ul class="list-group">
    @foreach($channels as $channel)
        <li class="list-group-item">
        <a href="{{ route('channels.show',['channel'=>$channel->id]) }}">{{$channel->title}}</a></li>
    @endforeach
        </ul>
        </div>
        </div>

        




        </ul>
    </div>

    <div class="col-sm-9">
            @yield('content')
    </div>
@else

    <div class="col-sm-12">
            @yield('content')
    </div>

@endif
</div>
    </div>
    <br>

<script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script>
@if(Session::has('success'))
    toastr.success("{{Session::get('success')}}")
@endif

@if(Session::has('error'))
    toastr.error("{{Session::get('error')}}")
@endif
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.6/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
</body>
</html>
