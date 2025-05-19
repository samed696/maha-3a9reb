@extends('layouts.app')

@section('title', 'Create Coupon')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-gradient-to-br from-gray-900 to-black shadow-2xl rounded-2xl overflow-hidden transform transition-all duration-300 hover:shadow-gray-800/50">
        <div class="px-6 py-8 sm:px-8 border-b border-gray-800">
            <h1 class="text-3xl font-bold text-white tracking-tight">Create a New Coupon</h1>
            <p class="mt-2 text-sm text-gray-400">Add a new discount coupon to your store</p>
        </div>

        @if(session('success'))
            <div class="mx-6 mt-6 rounded-lg bg-green-900/50 p-4 border border-green-800">
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

        <div class="px-6 py-8 sm:px-8">
            <form method="POST" action="{{ route('coupons.store') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-300 mb-2">Code</label>
                    <input type="text" name="code" id="code" class="block w-full rounded-lg bg-gray-800 border-gray-700 text-gray-300 shadow-sm focus:border-gray-600 focus:ring-gray-600" placeholder="Enter coupon code" required>
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-300 mb-2">Type</label>
                    <select name="type" id="type" class="block w-full rounded-lg bg-gray-800 border-gray-700 text-gray-300 shadow-sm focus:border-gray-600 focus:ring-gray-600" required>
                        <option value="fixed">Fixed Amount</option>
                        <option value="percent">Percentage</option>
                    </select>
                </div>

                <div>
                    <label for="value" class="block text-sm font-medium text-gray-300 mb-2">Value</label>
                    <input type="number" step="0.01" name="value" id="value" class="block w-full rounded-lg bg-gray-800 border-gray-700 text-gray-300 shadow-sm focus:border-gray-600 focus:ring-gray-600" placeholder="Enter discount value" required>
                </div>

                <div>
                    <label for="expiry_date" class="block text-sm font-medium text-gray-300 mb-2">Expiry Date</label>
                    <input type="date" name="expiry_date" id="expiry_date" class="block w-full rounded-lg bg-gray-800 border-gray-700 text-gray-300 shadow-sm focus:border-gray-600 focus:ring-gray-600">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-300 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Create Coupon
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
