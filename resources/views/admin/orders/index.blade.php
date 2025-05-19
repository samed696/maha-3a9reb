@extends('layouts.app')

@section('title', 'Manage Orders')

@section('content')
<div class="bg-gradient-to-br from-gray-900 to-black min-h-screen py-8">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-white">Manage Orders</h1>
        </div>

        <div class="bg-gray-800 rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-400 text-sm border-b border-gray-700">
                            <th class="px-6 py-4">Order ID</th>
                            <th class="px-6 py-4">Customer</th>
                            <th class="px-6 py-4">Date</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Total</th>
                            <th class="px-6 py-4">Items</th>
                            <th class="px-6 py-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-white">
                        @forelse($orders as $order)
                            <tr class="border-b border-gray-700 hover:bg-gray-700/50">
                                <td class="px-6 py-4">#{{ $order->id }}</td>
                                <td class="px-6 py-4">{{ $order->user->name }}</td>
                                <td class="px-6 py-4">{{ $order->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-sm font-medium
                                        @if($order->status === 'completed') bg-green-500/10 text-green-500
                                        @elseif($order->status === 'pending') bg-yellow-500/10 text-yellow-500
                                        @else bg-gray-500/10 text-gray-500
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">${{ number_format($order->total_price, 2) }}</td>
                                <td class="px-6 py-4">{{ $order->items->count() }} items</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('orders.show', $order) }}" 
                                       class="text-blue-500 hover:text-blue-400">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-400">
                                    No orders found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-700">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 