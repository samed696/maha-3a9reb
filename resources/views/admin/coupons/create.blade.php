@extends('layouts.app')

@section('title', 'Create Coupon')

@section('content')
<div class="bg-gradient-to-br from-gray-900 to-black min-h-screen py-8">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white">Create New Coupon</h1>
                <p class="text-gray-400 mt-2">Create a new discount coupon for your store</p>
            </div>

            <!-- Form -->
            <div class="bg-gray-800 rounded-lg p-6">
                <form action="{{ route('coupons.store') }}" method="POST">
                    @csrf

                    <!-- Code -->
                    <div class="mb-6">
                        <label for="code" class="block text-sm font-medium text-gray-400 mb-2">Coupon Code</label>
                        <input type="text" name="code" id="code" 
                               class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-blue-500"
                               value="{{ old('code') }}" required>
                        @error('code')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-400 mb-2">Description</label>
                        <textarea name="description" id="description" rows="3"
                                  class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-blue-500">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Type -->
                    <div class="mb-6">
                        <label for="type" class="block text-sm font-medium text-gray-400 mb-2">Discount Type</label>
                        <select name="type" id="type"
                                class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-blue-500">
                            <option value="fixed" {{ old('type') === 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                            <option value="percent" {{ old('type') === 'percent' ? 'selected' : '' }}>Percentage</option>
                        </select>
                        @error('type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Value -->
                    <div class="mb-6">
                        <label for="value" class="block text-sm font-medium text-gray-400 mb-2">Discount Value</label>
                        <input type="number" name="value" id="value" step="0.01" min="0"
                               class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-blue-500"
                               value="{{ old('value') }}" required>
                        @error('value')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Min Purchase -->
                    <div class="mb-6">
                        <label for="min_purchase" class="block text-sm font-medium text-gray-400 mb-2">Minimum Purchase Amount</label>
                        <input type="number" name="min_purchase" id="min_purchase" step="0.01" min="0"
                               class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-blue-500"
                               value="{{ old('min_purchase') }}">
                        @error('min_purchase')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Usage Limit -->
                    <div class="mb-6">
                        <label for="usage_limit" class="block text-sm font-medium text-gray-400 mb-2">Usage Limit</label>
                        <input type="number" name="usage_limit" id="usage_limit" min="0"
                               class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-blue-500"
                               value="{{ old('usage_limit') }}">
                        @error('usage_limit')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Expires At -->
                    <div class="mb-6">
                        <label for="expires_at" class="block text-sm font-medium text-gray-400 mb-2">Expiration Date</label>
                        <input type="date" name="expires_at" id="expires_at"
                               class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-blue-500"
                               value="{{ old('expires_at') }}">
                        @error('expires_at')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Is Active -->
                    <div class="mb-6">
                        <label class="flex items-center space-x-3">
                            <input type="checkbox" name="is_active" value="1"
                                   class="form-checkbox h-5 w-5 text-blue-600 rounded border-gray-600 bg-gray-700"
                                   {{ old('is_active') ? 'checked' : '' }}>
                            <span class="text-gray-400">Active</span>
                        </label>
                        @error('is_active')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('coupons.index') }}"
                           class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-colors duration-200">
                            Cancel
                        </a>
                        <button type="submit"
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
                            Create Coupon
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 