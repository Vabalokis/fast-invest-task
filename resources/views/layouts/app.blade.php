<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css" integrity="sha256-piqEf7Ap7CMps8krDQsSOTZgF+MU/0MPyPW2enj5I40=" crossorigin="anonymous" />
</head>
<body>
    <div id="app">

        <nav class="navigation">
            <ul class="navigation__list">
                @guest
                    @if (\Request::is('register'))  
                    <li class="navigation__list_item">
                        <a class="btn" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @endif
                    @if (\Request::is('login'))  
                        <li class="navigation__list_item">
                            <a class="btn" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="navigation__list_item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <input class="btn" type="submit" value="Logout">
                        </form>
                    </li>
                @endguest
            </ul>
        </nav>

        <main>
            @yield('content')
        </main>

    </div>
</body>
</html>
