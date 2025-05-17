<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Online Store')</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        body { 
            background-color: #f8f9fa; 
            animation: fadeIn 1.5s ease-in-out;
        }

        .navbar-brand { 
            font-weight: bold; 
            font-size: 1.4rem; 
            animation: bounceIn 2s;
        }

        footer { 
            background-color: #343a40; 
            color: white; 
            padding: 20px 0; 
            animation: fadeInUp 2s;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        @keyframes bounceIn {
            0% { transform: scale(0); opacity: 0; }
            50% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(1); }
        }

        @keyframes fadeInUp {
            0% { transform: translateY(30px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        .navbar-nav a {
            animation: fadeIn 2s;
        }
    </style>

    @stack('styles')
</head>
<body>
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" data-aos="fade-down">
                    <i class="fas fa-store"></i> Online Store
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item" data-aos="fade-right"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                        <li class="nav-item" data-aos="fade-right"><a class="nav-link" href="{{ route('products.index') }}">Products</a></li>
                        <li class="nav-item" data-aos="fade-right"><a class="nav-link" href="{{ route('cart.index') }}">Cart</a></li>
                        <li class="nav-item" data-aos="fade-right"><a class="nav-link" href="{{ route('wishlist.index') }}">Wishlist</a></li>
                        @auth
                            @if(Auth::user()->is_admin)
                                <li class="nav-item" data-aos="fade-right"><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                                <li class="nav-item" data-aos="fade-right"><a class="nav-link" href="{{ route('coupons.index') }}">Manage Coupons</a></li>
                            @else
                                <li class="nav-item" data-aos="fade-right"><a class="nav-link" href="{{ route('user.profile') }}">My Profile</a></li>
                                <li class="nav-item" data-aos="fade-right"><a class="nav-link" href="{{ route('user.orders') }}">My Orders</a></li>
                            @endif
                        @endauth
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li class="nav-item" data-aos="fade-left"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            <li class="nav-item" data-aos="fade-left"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="nav-item dropdown" data-aos="fade-left">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-5">
            <div class="container" data-aos="zoom-in">
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="text-center">
            <div class="container">
                &copy; {{ date('Y') }} Online Store. All rights reserved.
            </div>
        </footer>
    </div>

    @stack('scripts')

    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
