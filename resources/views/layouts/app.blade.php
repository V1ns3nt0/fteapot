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
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body style="max-width:1200px;" class="mx-auto">
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm" style="min-height:70px;">
            <div class="container">
                <a class="navbar-brand nav-headers-links" style="fontSize:20px;" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                      <li class="nav-item ">
                          <a href="/" class="nav-link green-text font-weight-bold nav-headers-links fnts-16">{{ __('Главная') }}</a>
                      </li>
                      <li class="nav-item">
                          <a href="/catalog" class="nav-link nav-headers-links fnts-16">{{ __('Чай') }}</a>
                      </li>
                      <li class="nav-item">
                          <a href="/library" class="nav-link nav-headers-links fnts-16">{{ __('Библиотека') }}</a>
                      </li>
                      <li class="nav-item">
                          <a href="/about" class="nav-link nav-headers-links fnts-16">{{ __('О нас') }}</a>
                      </li>
                      <li class="nav-item">
                          <a href="/delivery" class="nav-link nav-headers-links fnts-16">{{ __('Доставка') }}</a>
                      </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                      <li class="nav-item">
                          <a href="/cart" class="nav-link nav-headers-links fnts-16">{{ __('Корзина') }}</a>
                      </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link nav-headers-links fnts-16" href="{{ route('login') }}">{{ __('Войти') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link nav-headers-links fnts-16" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                                </li>
                            @endif
                        @else
                          @if(Auth::user()->is_admin == 1)
                            <li class="nav-item">
                                <a class="nav-link nav-headers-links fnts-16" href="/admin">{{ __('Админ') }}</a>
                            </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle nav-headers-links fnts-16" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
        <footer class="page-footer font-small blue-grey lighten-5">
            <div class="container text-center text-md-left mt-5">
                <div class="row mt-3 dark-grey-text">
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4 mt-5">
                        <h6 class="text-uppercase font-weight-bold nav-headers-links">Навигация</h6>
                        <hr class="green accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                        <p>
                            <a class="dark-grey-text" href="/">Главная</a>
                        </p>
                        <p>
                            <a class="dark-grey-text" href="/catalog">Чай</a>
                        </p>
                        <p>
                            <a class="dark-grey-text" href="/about">О нас</a>
                        </p>
                        <p>
                            <a class="dark-grey-text" href="/delivery">Доставка</a>
                        </p>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4 mt-5">
                        <h6 class="text-uppercase font-weight-bold nav-headers-links">Личный кабинет</h6>
                        <hr class="green accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                        @guest
                        <p>
                            <a class="dark-grey-text" href="{{ route('register') }}">Зарегистрироваться</a>
                        </p>
                        <p>
                            <a class="dark-grey-text" href="{{ route('login') }}">Войти</a>
                        </p>
                        @else
                        <p>
                            <a class="dark-grey-text" href="/home/orders">Мои заказы</a>
                        </p>
                        <p>
                            <a class="dark-grey-text" href="/home/edit">Редактировать данные</a>
                        </p>
                        <p>
                            <a class="dark-grey-text" href="/home/userCard">Дисконтная карта</a>
                        </p>
                        @endguest
                    </div>
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4 mt-5">
                        <h6 class="text-uppercase font-weight-bold nav-headers-links">Контакты</h6>
                        <hr class="green accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                        <p>
                            <i class="fas fa-home mr-3"></i>Япония, Токио, Шибуя</p>
                        <p>
                            <i class="fas fa-envelope mr-3"></i>ugl_tea@pr.ru</p>
                        <p>
                            <i class="fas fa-phone mr-3"></i> 8 888 666 77 55</p>
                        <p>
                            <i class="fas fa-print mr-3"></i> 8 656 234 47 94</p>
                    </div>

                </div>

            </div>
            <div class="footer-copyright text-center text-black-50 py-3">
                <p>&copy;Forgotten Teapot, 2020</p>
            </div>
        </footer>
    </div>
</body>
</html>
