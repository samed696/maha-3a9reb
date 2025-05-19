@extends('layouts.app')

@section('title', 'My Wishlist')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-gradient-to-br from-gray-900 to-black shadow-2xl rounded-2xl overflow-hidden transform transition-all duration-300 hover:shadow-gray-800/50">
        <div class="px-6 py-8 sm:px-8 border-b border-gray-800">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white tracking-tight">My Wishlist</h1>
                    <p class="mt-2 text-sm text-gray-400">Your carefully curated collection of favorite items</p>
                </div>
                <div class="hidden sm:block">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gray-800 text-gray-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        {{ $wishlist->count() }} Items
                    </span>
                </div>
            </div>
        </div>

    @if ($wishlist->isEmpty())
            <div class="px-6 py-12 sm:px-8 text-center">
                <div class="max-w-md mx-auto">
                    <svg class="mx-auto h-16 w-16 text-gray-600 transform transition-transform duration-300 hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <h3 class="mt-4 text-xl font-semibold text-white">Your wishlist is empty</h3>
                    <p class="mt-2 text-sm text-gray-400">Start adding items to your wishlist to keep track of your favorite products.</p>
                    <div class="mt-8">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-300 transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Browse Products
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="divide-y divide-gray-800">
                @foreach ($wishlist as $product)
                    <div class="p-6 hover:bg-gray-800/50 transition-all duration-300 ease-in-out transform hover:scale-[1.01]">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center space-x-6">
                                    @if($product->image)
                                        <div class="flex-shrink-0 h-24 w-24">
                                            <img class="h-24 w-24 rounded-xl object-cover shadow-lg transform transition-transform duration-300 hover:scale-105" src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                                        </div>
                                    @endif
                                    <div class="flex-1">
                                        <h2 class="text-xl font-semibold text-white group">
                                            <a href="{{ route('products.show', $product) }}" class="hover:text-gray-300 transition-colors duration-300">
                                                {{ $product->name }}
                                            </a>
                                        </h2>
                                        <p class="mt-2 text-sm text-gray-400 line-clamp-2">{{ $product->description }}</p>
                                        <div class="mt-3 flex items-center space-x-4">
                                            <p class="text-lg font-medium text-gray-300">€{{ number_format($product->price, 2) }}</p>
                                            @if($product->stock > 0)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-900 text-green-300">
                                                    In Stock
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-900 text-red-300">
                                                    Out of Stock
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 md:mt-0 md:ml-6 flex flex-col space-y-3">
                                <a href="{{ route('cart.add', $product->id) }}" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-lg text-white bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-300 transform hover:scale-105">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Add to Cart
                                </a>
                <form action="{{ route('wishlist.remove', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center px-5 py-2.5 border border-gray-700 text-sm font-medium rounded-lg text-gray-300 bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-300 transform hover:scale-105">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Remove
                                    </button>
                </form>
                            </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    </div>
</div>
@endsection