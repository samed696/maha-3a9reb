@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-gray-900 to-black text-white">
        <div class="container mx-auto px-6 py-20">
            <div class="max-w-3xl">
                <h1 class="text-5xl font-bold mb-6 tracking-tight">Welcome to Our Online Store</h1>
                <p class="text-xl mb-8 text-gray-300">Discover high-quality products at the best prices with excellent customer service and fast delivery</p>
            </div>
        </div>
    </div>

    @if (!auth()->check())
        <!-- Call to Action -->
        <div class="bg-gradient-to-br from-gray-900 to-black py-16">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold text-white mb-4">Join Us Today</h2>
                <p class="text-xl text-gray-300 mb-8">Sign up now to get the best offers and discounts</p>
                <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-gray-800 text-white rounded-lg font-semibold hover:bg-gray-700 transition-all duration-300 transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    Create New Account
                </a>
            </div>
        </div>
    @endif

    <!-- Filter Form -->
    <div class="bg-gray-900 shadow-xl">
        <div class="container mx-auto px-6 py-8">
            <form method="GET" action="{{ route('home') }}" class="grid grid-cols-1 md:grid-cols-5 gap-6">
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-300 mb-2">Category</label>
                    <select name="category" id="category" class="w-full rounded-lg bg-gray-800 border-gray-700 text-gray-300 shadow-sm focus:border-gray-600 focus:ring-gray-600" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
                <div>
                    <label for="min_price" class="block text-sm font-medium text-gray-300 mb-2">Min Price</label>
                    <input type="number" name="min_price" id="min_price" value="{{ request('min_price') }}" min="0" step="0.01" class="w-full rounded-lg bg-gray-800 border-gray-700 text-gray-300 shadow-sm focus:border-gray-600 focus:ring-gray-600" onchange="this.form.submit()">
            </div>
                <div>
                    <label for="max_price" class="block text-sm font-medium text-gray-300 mb-2">Max Price</label>
                    <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}" min="0" step="0.01" class="w-full rounded-lg bg-gray-800 border-gray-700 text-gray-300 shadow-sm focus:border-gray-600 focus:ring-gray-600" onchange="this.form.submit()">
            </div>
                <div>
                    <label for="min_rating" class="block text-sm font-medium text-gray-300 mb-2">Min Rating</label>
                    <select name="min_rating" id="min_rating" class="w-full rounded-lg bg-gray-800 border-gray-700 text-gray-300 shadow-sm focus:border-gray-600 focus:ring-gray-600" onchange="this.form.submit()">
                    <option value="">Any</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ request('min_rating') == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                </select>
            </div>
                <div>
                    <label for="sort" class="block text-sm font-medium text-gray-300 mb-2">Sort By</label>
                    <select name="sort" id="sort" class="w-full rounded-lg bg-gray-800 border-gray-700 text-gray-300 shadow-sm focus:border-gray-600 focus:ring-gray-600" onchange="this.form.submit()">
                    <option value="">Default</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z to A</option>
                    <option value="popularity" {{ request('sort') == 'popularity' ? 'selected' : '' }}>Popularity</option>
                </select>
            </div>
            </form>
        </div>
    </div>

    <!-- Products Listing -->
    @if(isset($products) && count($products) > 0)
        <div class="container mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($products as $product)
                    <div class="bg-gray-900 rounded-xl shadow-xl overflow-hidden transform transition-all duration-300 hover:scale-[1.02] hover:shadow-gray-800/50">
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" class="w-full h-48 object-cover transform transition-transform duration-300 hover:scale-105" alt="{{ $product->name }}">
                        @else
                            <div class="w-full h-48 bg-gray-800 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-white mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-400 mb-4">{{ Str::limit($product->description, 80) }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-2xl font-bold text-gray-300">${{ $product->price }}</span>
                                <a href="{{ route('products.show', $product->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition-all duration-300 transform hover:scale-105">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
        </div>
    @else
        <div class="container mx-auto px-6 py-16 text-center">
            <svg class="w-16 h-16 text-gray-600 mx-auto mb-4 transform transition-transform duration-300 hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-xl text-gray-400">No products found matching your criteria</p>
        </div>
    @endif

    <!-- Features Section في الأسفل فقط لهذه الصفحة -->
    <div class="bg-gray-900 py-16">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg text-center transform transition-all duration-300 hover:scale-105">
                    <div class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">High Quality Products</h3>
                    <p class="text-gray-400">We select the best products with high quality</p>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg text-center transform transition-all duration-300 hover:scale-105">
                    <div class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Fast Delivery</h3>
                    <p class="text-gray-400">We deliver your order quickly to your doorstep</p>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg text-center transform transition-all duration-300 hover:scale-105">
                    <div class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Secure Payment</h3>
                    <p class="text-gray-400">Multiple secure payment methods</p>
                </div>
            </div>
        </div>
    </div>
@endsection
