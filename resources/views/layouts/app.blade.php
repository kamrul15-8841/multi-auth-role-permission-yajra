<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KAMRUL') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap CSS -->
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">--}}

    <!-- Yajra DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            @else
                            <li class="nav-item">
                                @can('role-list')
                                <a id="" class="nav-link" href="{{ route('permissions.index') }}" role="button" data-bs-toggle="" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Permissions
                                </a>
                                @endcan
                            </li>
                            <li class="nav-item">
                                @can('role-list')
                                <a id="" class="nav-link" href="{{ route('roles.index') }}" role="button" data-bs-toggle="" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Role
                                </a>
                                @endcan
                            </li>
                            <li class="nav-item">
                                @can('user-list')
                                <a id="" class="nav-link" href="{{ route('users.index') }}" role="button" data-bs-toggle="" aria-haspopup="true" aria-expanded="false" v-pre>
                                    User
                                </a>
                                @endcan
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Portfolio Management
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a id="" class="nav-link" href="{{ route('projects.index') }}" role="button" data-bs-toggle="" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Projects
                                        </a>
                                        <a id="" class="nav-link" href="{{ route('roles.index') }}" role="button" data-bs-toggle="" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Role
                                        </a>
                                        <a id="" class="nav-link" href="{{ route('permissions.index') }}" role="button" data-bs-toggle="" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Permissions
                                        </a>
                                </div>
                            </li>
                            @can('user-list')
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    User Management
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @can('user-list')
                                        <a id="" class="nav-link" href="{{ route('users.index') }}" role="button" data-bs-toggle="" aria-haspopup="true" aria-expanded="false" v-pre>
                                            User
                                        </a>
                                    @endcan
                                    @can('role-list')
                                        <a id="" class="nav-link" href="{{ route('roles.index') }}" role="button" data-bs-toggle="" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Role
                                        </a>
                                    @endcan
                                    @can('role-list')
                                        <a id="" class="nav-link" href="{{ route('permissions.index') }}" role="button" data-bs-toggle="" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Permissions
                                        </a>
                                    @endcan
                                </div>
                            </li>
                            @endcan
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
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
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap JS -->
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>--}}

    <!-- Yajra DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    @stack('scripts')
</body>
</html>
