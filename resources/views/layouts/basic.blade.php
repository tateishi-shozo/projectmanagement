<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('title')
        <title>@yield('title') | {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-info .text-dark shadow-sm">
            <div class="container">
                @if(Auth::user()->is_admin == "2")
                    <a class="navbar-brand" href="{{ url('admin/project/index') }}">
                        {{ config('app.name') }}
                    </a>
                @else
                    <a class="navbar-brand" href="{{ route('user.index', ['user' => Auth::user()->id,]) }}">
                        {{ config('app.name') }}
                    </a>
                @endif
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @if(Auth::user()->is_admin == "2")
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item"><a class="nav-link" href="{{ url('admin/project/index') }}"><i class="fas fa-home mr-1"></i>工事一覧</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('user/dialy/index') }}"><i class="fas fa-home mr-1"></i>日報一覧</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('admin/profile/index') }}"><i class="fas fa-home mr-1"></i>ユーザー一覧</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('admin/license/index') }}"><i class="fas fa-home mr-1"></i>資格編集</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('admin/fee/index') }}"><i class="fas fa-home mr-1"></i>料金編集</a></li>
                        </ul>
                    @else
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item"><a class="nav-link" href="{{ route('user.index', ['user' => Auth::user()->id,]) }}"><i class="fas fa-home mr-1"></i>工事一覧</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('user/dialy/index') }}"><i class="fas fa-home mr-1"></i>日報一覧</a></li>
                        </ul>
                    @endif

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
                                @if(isset(Auth::user()->profile->image))
                                    <img src="{{ Auth::user()->profile->image }}" width="30" height="30" class="rounded-circle">
                                @endif
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if(isset(Auth::user()->profile))
                                    <a class="nav-link" href="{{ url('user/profile/') }}"><i class="fas fa-home mr-1"></i> プロフィール</a>
                                @endif
                                    <a class="dropdown-item" href="{{ route('login') }}"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fas fa-home mr-1"></i>ログアウト</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
