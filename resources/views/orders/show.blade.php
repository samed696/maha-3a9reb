@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="bg-gradient-to-br from-gray-900 to-black min-h-screen py-8">
    <div class="container mx-auto px-4">
        <div class="bg-gray-800 rounded-xl shadow-xl p-6">
            <h1 class="text-2xl font-bold text-white mb-6">Order Details - <span class="text-blue-400">#{{ $order->id }}</span></h1>
            <div class="mb-6 space-y-2">
                <p class="text-gray-300"><span class="font-semibold text-white">Order Date:</span> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                <p class="text-gray-300">
                    <span class="font-semibold text-white">Status:</span>
                    <span class="px-3 py-1 rounded-full text-sm font-medium
                        @if($order->status === 'completed') bg-green-500/10 text-green-400
                        @elseif($order->status === 'pending') bg-yellow-500/10 text-yellow-400
                        @else bg-gray-500/10 text-gray-400 @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>
                <p class="text-gray-300"><span class="font-semibold text-white">Total Price:</span> ${{ number_format($order->total_price, 2) }}</p>
            </div>

            <h2 class="text-xl font-semibold text-white mb-4">Items</h2>
            @if($order->items->isEmpty())
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="text-gray-400">No items found for this order.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-800">
                        <thead class="bg-gray-800/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Product</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Quantity</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Price</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-900/50 divide-y divide-gray-800">
                            @foreach($order->items as $item)
                                <tr class="hover:bg-gray-800/50 transition-colors duration-300">
                                    <td class="px-6 py-4 whitespace-nowrap text-white">{{ $item->product->name ?? 'Product not found' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ $item->quantity }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">${{ number_format($item->price, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <div class="mt-8">
                <a href="{{ route('user.orders') }}" class="inline-flex items-center px-6 py-3 bg-gray-800 text-white rounded-lg font-semibold hover:bg-gray-700 transition-all duration-300 transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Orders
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
