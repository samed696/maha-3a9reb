@extends('layouts.app')

@section('title', 'My Orders')

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
        <div class="bg-gray-800 rounded-xl shadow-xl p-6">
            <h1 class="text-2xl font-bold text-white mb-6">My Orders</h1>
            @if($orders->isEmpty())
                <div class="text-center py-16">
                    <svg class="mx-auto h-16 w-16 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2a4 4 0 004 4h10a4 4 0 004-4v-2a4 4 0 00-4-4h-1a4 4 0 00-4 4v2z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-white mb-2">You have no orders yet.</h3>
                    <p class="text-gray-400">Start shopping and your orders will appear here.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-800">
                        <thead class="bg-gray-800/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Order ID</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Details</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-900/50 divide-y divide-gray-800">
                            @foreach($orders as $order)
                                <tr class="hover:bg-gray-800/50 transition-colors duration-300">
                                    <td class="px-6 py-4 whitespace-nowrap text-white">#{{ $order->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ $order->created_at->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">${{ number_format($order->total_price, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 rounded-full text-sm font-medium
                                            @if($order->status === 'completed') bg-green-500/10 text-green-400
                                            @elseif($order->status === 'pending') bg-yellow-500/10 text-yellow-400
                                            @else bg-gray-500/10 text-gray-400 @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('orders.show', $order->id) }}" class="text-blue-400 hover:text-blue-300 transition-colors duration-300">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-6 flex justify-center">
                    {{ $orders->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
