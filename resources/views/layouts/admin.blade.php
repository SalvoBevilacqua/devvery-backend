<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('pittogramma.ico') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('admin_page_name')</title>

    <!-- Fontawesome 6 cdn -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'
        integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">

        <header class="navbar sticky-top flex-md-nowrap py-1 shadow px-5 ms_bg-yellow align-items-center">
            <a class="navbar-brand me-0 px-3" href="http://localhost:4242/">
                <img class="w-25" src="{{ Vite::asset('resources\img\logotipo.png') }}" alt="Logo Devvery">
            </a>

            <div class="navbar-nav d-md-flex flex-row align-items-center d-none">
                <div class="dropdown me-2">
                    <button class="btn ms_btn-dark dropdown-toggle" type="button" id="dropdownMenuButton2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>

                    <ul class="dropdown-menu dropdown-menu-dark position-absolute">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </div>
            </div>
        </header>

        <div class="w-100">
            <div class="d-flex flex-column flex-md-row">
                <nav id="sidebarMenu" class="shadow shadow-4 p-4">
                    <ul class="m-0 p-0 d-flex flex-row flex-md-column gap-4 justify-content-around">
                        <li class="list-group-item">
                            <a class=" {{ Route::currentRouteName() == 'admin.dashboard' ? 'ms_color-yellow' : 'ms_color-dark' }}"
                                href="{{ route('admin.dashboard') }}">
                                <i class="fa-solid fa-house"></i>
                            </a>
                        </li>
                        @if (Auth::user()->restaurant)
                            <li class="list-group-item">
                                <a class="{{ Route::currentRouteName() == 'admin.foods.index' ? 'ms_color-yellow' : 'ms_color-dark' }}"
                                    href="{{ route('admin.foods.index') }}">
                                    <i class="fa-solid fa-utensils"></i>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a class="{{ Route::currentRouteName() == 'admin.orders.index' ? 'ms_color-yellow' : 'ms_color-dark' }}"
                                    href="{{ route('admin.orders.index') }}">
                                    <i class="fa-solid fa-cash-register"></i>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a class="{{ Route::currentRouteName() == 'admin.stats' ? 'ms_color-yellow' : 'ms_color-dark' }}"
                                    href="{{ route('admin.stats') }}">
                                    <i class="fa-solid fa-chart-line"></i>
                                </a>
                            </li>
                        @endif

                        <li class="d-block d-md-none">
                            <a class="nav-item px-2 ms_color-red" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>

                <main class="w-100">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    {{-- Pages scripts --}}
    @yield('scripts')
</body>

</html>
