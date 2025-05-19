@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="bg-gradient-to-br from-gray-900 to-black min-h-screen py-8">
    <div class="container mx-auto px-4">
        <div class="bg-gray-800 rounded-xl shadow-2xl overflow-hidden">
            <!-- Product Details -->
            <div class="p-6">
                <div class="lg:grid lg:grid-cols-2 lg:gap-8">
                    <!-- Product Image -->
                    <div class="mb-8 lg:mb-0">
                        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-700">
                            @if($product->image_url)
                                <img src="{{ asset('storage/'.$product->image_url) }}" 
                                     alt="{{ $product->name }}" 
                                     class="h-full w-full object-cover object-center transform transition-transform duration-300 hover:scale-105">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="space-y-6">
                        <div>
                            <h1 class="text-3xl font-bold text-white mb-2">{{ $product->name }}</h1>
                            <div class="bg-gray-700/50 rounded-lg p-4">
                                <h2 class="text-lg font-semibold text-white mb-2">Description</h2>
                                <p class="text-gray-300 whitespace-pre-line">{{ $product->description }}</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="text-3xl font-bold text-white">${{ number_format($product->price, 2) }}</div>
                            <div class="text-sm text-gray-400">
                                @if($product->stock > 0)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-500/10 text-green-400">
                                        In Stock ({{ $product->stock }})
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-500/10 text-red-400">
                                        Out of Stock
                                    </span>
                                @endif
                            </div>
                        </div>

                        @auth
                            @if(!Auth::user()->is_admin)
                                <div class="space-y-4">
                                    <a href="{{ route('cart.add', $product->id) }}" 
                                       class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:scale-105">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Add to Cart
                                    </a>

                                    <form action="{{ route('wishlist.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" 
                                                class="w-full inline-flex items-center justify-center px-6 py-3 border border-red-500/20 text-base font-medium rounded-lg text-red-400 bg-red-500/10 hover:bg-red-500/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-300 transform hover:scale-105">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                            Add to Wishlist
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="bg-gray-900 rounded-xl shadow-xl p-6 mt-8">
                <h3 class="text-2xl font-bold text-white mb-6">Customer Reviews</h3>

                @auth
                    <!-- Review Form -->
                    <form action="{{ route('products.reviews.store', $product->id) }}" method="POST" class="mb-8">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-300 mb-2">Rating</label>
                            <div class="flex space-x-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="button" class="star-rating" data-rating="{{ $i }}">
                                        <svg class="w-8 h-8 text-gray-600 hover:text-yellow-400 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>
                                    </button>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="rating" value="0">
                        </div>
                        <div class="mb-4">
                            <label for="comment" class="block text-gray-300 mb-2">Your Review</label>
                            <textarea name="comment" id="comment" rows="4" class="w-full rounded-lg bg-gray-800 border-gray-700 text-gray-300 shadow-sm focus:border-gray-600 focus:ring-gray-600" required></textarea>
                        </div>
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-gray-800 text-white rounded-lg font-semibold hover:bg-gray-700 transition-all duration-300 transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Submit Review
                        </button>
                    </form>
                @else
                    <div class="bg-gray-800 rounded-lg p-4 mb-8">
                        <p class="text-gray-300">Please <a href="{{ route('login') }}" class="text-white hover:text-gray-300 underline">login</a> to write a review.</p>
                    </div>
                @endauth

                <!-- Display Reviews -->
                <div class="space-y-6">
                    @forelse($product->reviews as $review)
                        <div class="bg-gray-800 rounded-lg p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-gray-700 flex items-center justify-center text-white font-semibold">
                                        {{ substr($review->user->name, 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-white font-semibold">{{ $review->user->name }}</h4>
                                        <div class="flex items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <span class="text-gray-400 text-sm">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-300">{{ $review->comment }}</p>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <p class="text-gray-400">No reviews yet. Be the first to review this product!</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Admin Actions -->
            @if(Auth::check() && Auth::user()->is_admin)
                <div class="border-t border-gray-700 px-6 py-4 bg-gray-700/50">
                    <div class="flex justify-between items-center">
                        <a href="{{ route('products.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-600 text-sm font-medium rounded-lg text-gray-300 bg-gray-700 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Back to Products
                        </a>
                        <div class="flex space-x-3">
                            <a href="{{ route('products.edit', $product->id) }}" 
                               class="inline-flex items-center px-4 py-2 border border-yellow-500/20 text-sm font-medium rounded-lg text-yellow-400 bg-yellow-500/10 hover:bg-yellow-500/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                Edit Product
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 border border-red-500/20 text-sm font-medium rounded-lg text-red-400 bg-red-500/10 hover:bg-red-500/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                        onclick="return confirm('Are you sure you want to delete this product?')">
                                    Delete Product
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('.star-rating');
        const ratingInput = document.getElementById('rating');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = this.dataset.rating;
                ratingInput.value = rating;
                
                // Update star colors
                stars.forEach(s => {
                    const starIcon = s.querySelector('svg');
                    if (s.dataset.rating <= rating) {
                        starIcon.classList.remove('text-gray-600');
                        starIcon.classList.add('text-yellow-400');
                    } else {
                        starIcon.classList.remove('text-yellow-400');
                        starIcon.classList.add('text-gray-600');
                    }
                });
            });

            // Hover effect
            star.addEventListener('mouseenter', function() {
                const rating = this.dataset.rating;
                stars.forEach(s => {
                    const starIcon = s.querySelector('svg');
                    if (s.dataset.rating <= rating) {
                        starIcon.classList.remove('text-gray-600');
                        starIcon.classList.add('text-yellow-400');
                    }
                });
            });

            star.addEventListener('mouseleave', function() {
                const currentRating = ratingInput.value;
                stars.forEach(s => {
                    const starIcon = s.querySelector('svg');
                    if (s.dataset.rating <= currentRating) {
                        starIcon.classList.remove('text-gray-600');
                        starIcon.classList.add('text-yellow-400');
                    } else {
                        starIcon.classList.remove('text-yellow-400');
                        starIcon.classList.add('text-gray-600');
                    }
                });
            });
        });
    });
</script>
@endpush
@endsection
