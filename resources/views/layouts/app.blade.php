<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Keyboard Haven</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Outfit:400,500,600,700|Inter:400,500,600" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            padding: 1rem 0;
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: #2563eb !important;
        }

        .nav-link {
            font-weight: 500;
            color: #4b5563 !important;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #2563eb !important;
        }

        .navbar-toggler {
            border: none;
            padding: 0.5rem;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-radius: 0.5rem;
            padding: 0.5rem;
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: #f3f4f6;
            color: #2563eb;
        }

        .btn-primary {
            background-color: #2563eb;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            transform: translateY(-1px);
        }

        main {
            min-height: calc(100vh - 80px);
        }

        /* Notification & Cart Badge Styles */
        .nav-link .badge {
            position: absolute;
            top: 0;
            right: 0;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            border-radius: 9999px;
            background-color: #ef4444;
            color: white;
            transform: translate(25%, -25%);
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('', 'Keyboard-Haven') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <!-- Add your navigation links here -->
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        @guest
                            @if (Route::has(''))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt me-1"></i>{{ __('Login') }}
                                    </a>
                                </li>
                            @endif

                            @if (Route::has(''))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <i class="fas fa-user-plus me-1"></i>{{ __('Register') }}
                                    </a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item position-relative me-3">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="fa-solid fa-store"></i>
                                <span class="badge"></span>
                            </a>
                        </li>
                            <li class="nav-item position-relative me-3">
                                <a class="nav-link" href="{{ route('cart.index') }}">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span class="badge"></span>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=2563eb&color=fff" 
                                         alt="Profile" 
                                         class="rounded-circle me-2"
                                         width="32"
                                         height="32">
                                    <span>{{ Auth::user()->name }}</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.view', Auth::user()->id) }}">
                                        <i class="fas fa-user me-2"></i>{{ __('Profile') }}
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>{{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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