<!doctype html>
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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="max-width:1200px;" class="mx-auto">
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                      <li class="nav-item ">
                          <a href="/" class="nav-link green-text font-weight-bold headFont">{{ __('Главная') }}</a>
                      </li>
                      <li class="nav-item">
                          <a href="/catalog" class="nav-link headFont">{{ __('Чай') }}</a>
                      </li>
                      <li class="nav-item">
                          <a href="/library" class="nav-link headFont">{{ __('Библиотека') }}</a>
                      </li>
                      <li class="nav-item">
                          <a href="/about" class="nav-link headFont">{{ __('О нас') }}</a>
                      </li>
                      <li class="nav-item">
                          <a href="/delivery" class="nav-link headFont">{{ __('Доставка') }}</a>
                      </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                      <li class="nav-item">
                          <a href="/cart" class="nav-link headFont">{{ __('Корзина') }}</a>
                      </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Войти') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                                </li>
                            @endif
                        @else
                          @if(Auth::user()->is_admin == 1)
                            <li class="nav-item">
                                <a class="nav-link" href="/admin">{{ __('Админ') }}</a>
                            </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="/home/orders">
                                      {{ __('Мои заказы') }}
                                  </a>
                                  <a class="dropdown-item" href="/home/edit">
                                      {{ __('Редактировать профиль') }}
                                  </a>
                                  <a class="dropdown-item" href="/home/userCard">
                                      {{ __('Скидочная карта') }}
                                  </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Выйти') }}
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
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
