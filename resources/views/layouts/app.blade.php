<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Online Store')</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body { 
            font-family: 'Inter', sans-serif;
            background-color: #000000;
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        .animate-slide-up {
            animation: slideUp 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>

    @stack('styles')
</head>
<body class="min-h-screen flex flex-col">
    <div id="app">
        <!-- Navbar -->
        <nav class="bg-gradient-to-r from-gray-900 to-black shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ url('/') }}" class="text-2xl font-bold text-white hover:text-gray-300 transition duration-300">
                                <svg class="w-8 h-8 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                                Online Store
                            </a>
                        </div>
                        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                            <a href="{{ url('/') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-white border-b-2 border-gray-500">Home</a>
                            @if (!auth()->check())
                                <!-- Only Home for guests -->
                            @elseif (Auth::user()->is_admin)
                                <a href="{{ route('products.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-300 hover:text-white hover:border-gray-300 border-b-2 border-transparent">Products</a>
                            @endif
                            @auth
                                <a href="{{ route('cart.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-300 hover:text-white hover:border-gray-300 border-b-2 border-transparent">Cart</a>
                                <a href="{{ route('wishlist.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-300 hover:text-white hover:border-gray-300 border-b-2 border-transparent">Wishlist</a>
                                @if(Auth::user()->is_admin)
                                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-300 hover:text-white hover:border-gray-300 border-b-2 border-transparent">Admin Dashboard</a>
                                    <a href="{{ route('coupons.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-300 hover:text-white hover:border-gray-300 border-b-2 border-transparent">Manage Coupons</a>
                                @else
                                    <a href="{{ route('user.profile') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-300 hover:text-white hover:border-gray-300 border-b-2 border-transparent">My Profile</a>
                                    <a href="{{ route('user.orders') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-300 hover:text-white hover:border-gray-300 border-b-2 border-transparent">My Orders</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:items-center">
                        @if(!auth()->check())
                            <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-2">Login</a>
                            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-gray-300 bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Register</a>
                        @else
                            <div class="ml-3 relative">
                                <div>
                                    <button type="button" class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" id="user-menu-button">
                                        <span class="sr-only">Open user menu</span>
                                        <div class="h-8 w-8 rounded-full bg-gray-800 flex items-center justify-center text-white">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </div>
                                    </button>
                                </div>
                                <div class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-gray-900 ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" id="user-menu">
                                    <a href="{{ route('user.settings') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-800" role="menuitem">
                                        Settings
                                    </a>
                                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-800" role="menuitem"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-300 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500" id="mobile-menu-button">
                            <span class="sr-only">Open main menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div class="hidden sm:hidden" id="mobile-menu">
                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{ url('/') }}" class="block pl-3 pr-4 py-2 border-l-4 border-gray-500 text-base font-medium text-white bg-gray-800">Home</a>
                    @if (!auth()->check())
                        <!-- Only Home for guests -->
                    @elseif (Auth::user()->is_admin)
                        <a href="{{ route('products.index') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-300 hover:text-white hover:bg-gray-800 hover:border-gray-300">Products</a>
                    @endif
                    @auth
                        <a href="{{ route('cart.index') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-300 hover:text-white hover:bg-gray-800 hover:border-gray-300">Cart</a>
                        <a href="{{ route('wishlist.index') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-300 hover:text-white hover:bg-gray-800 hover:border-gray-300">Wishlist</a>
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-300 hover:text-white hover:bg-gray-800 hover:border-gray-300">Admin Dashboard</a>
                            <a href="{{ route('coupons.index') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-300 hover:text-white hover:bg-gray-800 hover:border-gray-300">Manage Coupons</a>
                        @else
                            <a href="{{ route('user.profile') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-300 hover:text-white hover:bg-gray-800 hover:border-gray-300">My Profile</a>
                            <a href="{{ route('user.orders') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-300 hover:text-white hover:bg-gray-800 hover:border-gray-300">My Orders</a>
                        @endif
                    @endauth
                </div>
                @if(!auth()->check())
                    <div class="pt-4 pb-3 border-t border-gray-800">
                        <div class="space-y-1">
                            <a href="{{ route('login') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-300 hover:text-white hover:bg-gray-800 hover:border-gray-300">Login</a>
                            <a href="{{ route('register') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-300 hover:text-white hover:bg-gray-800 hover:border-gray-300">Register</a>
                        </div>
                    </div>
                @endif
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow">
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <p class="text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} Online Store. All rights reserved.
                </p>
            </div>
        </footer>
    </div>

    @stack('scripts')

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // User menu toggle
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');
        userMenuButton.addEventListener('click', () => {
            userMenu.classList.toggle('hidden');
        });

        // Close menus when clicking outside
        document.addEventListener('click', (event) => {
            if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
                userMenu.classList.add('hidden');
            }
            if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
