@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="bg-gradient-to-br from-gray-900 to-black min-h-screen py-8">
    <div class="container mx-auto px-4">
        @if(session('success'))
            <div class="rounded-lg bg-green-900/50 p-4 mb-6 border border-green-800">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-green-300 text-sm font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="rounded-lg bg-red-900/50 p-4 mb-6 border border-red-800">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span class="text-red-300 text-sm font-medium">{{ session('error') }}</span>
                </div>
            </div>
        @endif
        <!-- Profile Header -->
        <div class="bg-gray-800 rounded-xl shadow-xl p-6 mb-8">
            <div class="flex items-center space-x-6">
                <div class="h-24 w-24 rounded-full bg-gray-700 flex items-center justify-center text-3xl font-bold text-white">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-white">{{ $user->name }}</h1>
                    <p class="text-gray-400">{{ $user->email }}</p>
                    <p class="text-gray-400">Member since {{ $user->created_at->format('F Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="bg-gray-800 rounded-xl shadow-xl p-6 mb-8">
            <h2 class="text-xl font-bold text-white mb-4">Recent Orders</h2>
            @if($orders->count() > 0)
                <div class="space-y-4">
                    @foreach($orders->take(5) as $order)
                        <div class="bg-gray-700/50 rounded-lg p-4">
                            <div class="flex justify-between items-center mb-2">
                                <div>
                                    <h3 class="text-white font-semibold">Order #{{ $order->id }}</h3>
                                    <p class="text-gray-400 text-sm">{{ $order->created_at->format('M d, Y') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-white font-semibold">${{ number_format($order->total_price, 2) }}</p>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($order->status === 'completed') bg-green-100 text-green-800
                                        @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                @foreach($order->items->take(3) as $item)
                                    <div class="w-12 h-12 rounded-lg bg-gray-600 flex items-center justify-center">
                                        @if($item->product->image_url)
                                            <img src="{{ asset('storage/'.$item->product->image_url) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover rounded-lg">
                                        @else
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        @endif
                                    </div>
                                @endforeach
                                @if($order->items->count() > 3)
                                    <div class="w-12 h-12 rounded-lg bg-gray-600 flex items-center justify-center text-gray-400">
                                        +{{ $order->items->count() - 3 }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    <a href="{{ route('user.orders') }}" class="text-blue-400 hover:text-blue-300">View all orders →</a>
                </div>
            @else
                <p class="text-gray-400">No orders yet.</p>
            @endif
        </div>

        <!-- Recent Reviews -->
        <div class="bg-gray-800 rounded-xl shadow-xl p-6">
            <h2 class="text-xl font-bold text-white mb-4">My Reviews</h2>
            @if($reviews->count() > 0)
                <div class="space-y-4">
                    @foreach($reviews->take(5) as $review)
                        <div class="bg-gray-700/50 rounded-lg p-4">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="text-white font-semibold">{{ $review->product->name }}</h3>
                                    <div class="flex items-center mt-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                <span class="text-gray-400 text-sm">{{ $review->created_at->format('M d, Y') }}</span>
                            </div>
                            <p class="text-gray-300">{{ $review->comment }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400">No reviews yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection
