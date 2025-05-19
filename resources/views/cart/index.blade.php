@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-gradient-to-br from-gray-900 to-black shadow-2xl rounded-2xl overflow-hidden transform transition-all duration-300 hover:shadow-gray-800/50">
        <div class="px-6 py-8 sm:px-8 border-b border-gray-800">
            <h1 class="text-3xl font-bold text-white tracking-tight">Shopping Cart</h1>
        </div>

        @if(session('success'))
            <div class="mx-6 mb-6 rounded-lg bg-green-900/50 p-4 border border-green-800">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-300">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mx-6 mb-6 rounded-lg bg-red-900/50 p-4 border border-red-800">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-red-300">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Coupon Form -->
        <div class="px-6 py-6 sm:px-8 border-b border-gray-800">
            <form action="{{ route('cart.applyCoupon') }}" method="POST" class="flex space-x-4">
                @csrf
                <div class="flex-1">
                    <input type="text" name="coupon_code" class="block w-full rounded-lg bg-gray-800 border-gray-700 text-gray-300 shadow-sm focus:border-gray-600 focus:ring-gray-600 sm:text-sm" placeholder="Enter coupon code">
                </div>
                <button type="submit" class="inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-lg text-white bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-300 transform hover:scale-105">
                    Apply Coupon
                </button>
            </form>
        </div>

        @if(!empty($cart))
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-800">
                    <thead class="bg-gray-800/50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Product</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Price</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Quantity</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-900/50 divide-y divide-gray-800">
                        @foreach($cart as $id => $item)
                            <tr class="hover:bg-gray-800/50 transition-colors duration-300">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-white">{{ $item['name'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-300">€{{ number_format($item['price'], 2) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-300">{{ $item['quantity'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('cart.remove', $id) }}" class="text-gray-400 hover:text-gray-300 transition-colors duration-300">
                                        <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-8 sm:px-8 border-t border-gray-800">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Order Summary -->
                    <div class="bg-gray-800/50 rounded-xl p-6 border border-gray-700">
                        <h3 class="text-lg font-medium text-white mb-4">Order Summary</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Subtotal</span>
                                <span class="text-gray-300">€{{ number_format($subtotal, 2) }}</span>
                            </div>
                            @if($discount > 0)
                                <div class="flex justify-between text-green-400">
                                    <span>Discount</span>
                                    <span>-€{{ number_format($discount, 2) }}</span>
                                </div>
                            @endif
                            <div class="border-t border-gray-700 pt-4 flex justify-between">
                                <span class="text-lg font-medium text-white">Total</span>
                                <span class="text-lg font-medium text-white">€{{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Checkout Form -->
                    <div class="flex items-center justify-end">
                        <form action="{{ route('order.store') }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-300 transform hover:scale-105">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Proceed to Checkout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <!-- تم حذف رسالة السلة الفارغة وزر Browse Products -->
        @endif
    </div>
</div>
@endsection
