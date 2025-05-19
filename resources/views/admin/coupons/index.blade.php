@extends('layouts.app')

@section('title', 'Manage Coupons')

@section('content')
<div class="bg-gradient-to-br from-gray-900 to-black min-h-screen py-8">
    <div class="container mx-auto px-4">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white">Manage Coupons</h1>
                <p class="text-gray-400 mt-2">Create and manage discount coupons for your store</p>
            </div>
            <a href="{{ route('coupons.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg flex items-center space-x-2 transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span>Create New Coupon</span>
            </a>
        </div>

        <!-- Coupons Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($coupons as $coupon)
                <div class="bg-gray-800 rounded-lg overflow-hidden">
                    <div class="p-6">
                        <!-- Coupon Header -->
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-semibold text-white">{{ $coupon->code }}</h3>
                                <p class="text-gray-400 text-sm">{{ $coupon->description }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-sm font-medium
                                @if($coupon->is_active) bg-green-500/10 text-green-500
                                @else bg-red-500/10 text-red-500
                                @endif">
                                {{ $coupon->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>

                        <!-- Coupon Details -->
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-400">Discount Type</span>
                                <span class="text-white font-medium">{{ ucfirst($coupon->type) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-400">Discount Value</span>
                                <span class="text-white font-medium">
                                    @if($coupon->type === 'fixed')
                                        ${{ number_format($coupon->value, 2) }}
                                    @else
                                        {{ $coupon->value }}%
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-400">Min. Purchase</span>
                                <span class="text-white font-medium">
                                    @if($coupon->min_purchase)
                                        ${{ number_format($coupon->min_purchase, 2) }}
                                    @else
                                        No minimum
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-400">Usage Limit</span>
                                <span class="text-white font-medium">
                                    @if($coupon->usage_limit)
                                        {{ $coupon->usage_limit }} times
                                    @else
                                        Unlimited
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-400">Expires At</span>
                                <span class="text-white font-medium">
                                    @if($coupon->expires_at)
                                        {{ $coupon->expires_at->format('M d, Y') }}
                                    @else
                                        Never
                                    @endif
                                </span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="mt-6 flex space-x-3">
                            <a href="{{ route('coupons.edit', $coupon) }}" 
                               class="flex-1 bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-center transition-colors duration-200">
                                Edit
                            </a>
                            <form action="{{ route('coupons.destroy', $coupon) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors duration-200"
                                        onclick="return confirm('Are you sure you want to delete this coupon?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-gray-800 rounded-lg p-8 text-center">
                        <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-white mb-2">No Coupons Found</h3>
                        <p class="text-gray-400 mb-6">Create your first coupon to start offering discounts to your customers</p>
                        <a href="{{ route('coupons.create') }}" 
                           class="inline-flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <span>Create New Coupon</span>
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($coupons->hasPages())
            <div class="mt-8">
                {{ $coupons->links() }}
            </div>
        @endif
    </div>
</div>
@endsection 