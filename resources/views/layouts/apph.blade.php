<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ichimuki') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body class="leading-normal tracking-normal text-white texture">
    <div>
        <nav id="header" class="fixed w-full z-30 top-0 text-white bg-white">
            <div class="flex justify-between container mx-auto p-5">
                <div>
                    <a href="{{ url('/') }}"
                        class="text-prim hover:text-lbl block px-3 py-2 rounded-md text-base font-medium">
                        {{ config('app.name', 'Ichimoku') }}
                    </a>
                </div>

                <div class="flex flex-row" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="flex flex-row">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="pr-5">
                                    <a class="text-prim hover:text-lbl block px-3 py-2 rounded-md text-base font-medium"
                                        href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="pr-5">
                                    <a class="bg-prim text-btnTxt block px-3 py-2 rounded-md text-base font-medium"
                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="flex items-center">
                                <div class="mr-5">
                                    {{-- <a>
                                    {{ Auth::user()->name }}
                                </a> --}}
                                </div>

                                <div class="pr-5 flex items-center" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('home') }}"
                                        class="text-prim hover:text-lbl block px-3 py-2 rounded-md text-base font-bold">
                                        {{ __('Dashboard') }}
                                    </a>
                                    <a href="{{ route('logout') }}"
                                        class="text-prim hover:text-lbl block px-3 py-2 rounded-md text-base font-medium"
                                        onclick="event.preventDefault();
                                                                                                                         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

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

        <main class="h-full">
            @yield('content')
        </main>
    </div>
</body>

</html>
