<!DOCTYPE doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <!-- CSRF Token -->
        <meta content="{{ csrf_token() }}" name="csrf-token"/>
        <title>
            {{ $_pageTitle ?? '' }} : {{ config('app.name', 'Laravel') }}
        </title>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}">
        </script>
        <!-- Fonts -->
        <link href="//fonts.gstatic.com" rel="dns-prefetch"/>
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"/>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark shadow-sm">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}" class="navbar-toggler" data-target="#navbarSupportedContent" data-toggle="collapse" type="button">
                        <span class="navbar-toggler-icon">
                        </span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            @if (!Auth::guest())
                            <li class="nav-item {{ Request::routeIs('home') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('home') }}">
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                            <li class="nav-item dropdown {{ Request::routeIs('users.index') ? 'active' : '' }}">
                                <a class="nav-link"  href="{{ route('users.index')}}" id="userDropdown" role="button">
                                    {{ __('Users') }}
                                </a>
                            </li>
                           
                            @endif
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    {{ __('Login') }}
                                </a>
                            </li>
                            @endif

                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    {{ __('Register') }}
                                </a>
                            </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="navbarDropdown" role="button" v-pre="">
                                    {{ Str::ucfirst(Auth::user()->username) }}
                                </a>
                                <div aria-labelledby="navbarDropdown" class="dropdown-menu dropdown-menu-right">
                                     <a class="dropdown-item {{ Request::routeIs('settings') ? 'active' : '' }}" href="{{ route('settings') }}">
                                        {{ __('Setting') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form action="{{ route('logout') }}" class="d-none" id="logout-form" method="POST">
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
                <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="defaultModalLabel"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            </div>

                        </div>
                    </div>
                </div>
            </main>
            <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
            <script src="{{ asset('js/custom.js') }}"></script>
            <script src="{{asset('js/flash_message.js')}}"></script>
            <script src="{{ asset('js/delete.js') }}"></script>
            <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>

            @stack('scripts')
            <script>
                @foreach (['error', 'warning', 'success', 'info'] as $message)
                @if(Session::has($message))
                flashMessage("{{ $message }}","{{ Session::get($message) }}");
                @endif
                @endforeach
            </script>
        </div>
    </body>
</html>
