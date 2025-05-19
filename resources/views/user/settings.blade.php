@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="bg-gradient-to-br from-gray-900 to-black min-h-screen py-8">
    <div class="container mx-auto px-4 max-w-lg">
        <div class="bg-gray-800 rounded-xl shadow-xl p-8">
            <h1 class="text-2xl font-bold text-white mb-6">Account Settings</h1>
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
            @if($errors->any())
                <div class="rounded-lg bg-red-900/50 p-4 mb-6 border border-red-800">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span class="text-red-300 text-sm font-medium">{{ $errors->first() }}</span>
                    </div>
                </div>
            @endif
            <form action="{{ route('user.settings.update') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-lg bg-gray-700 border-gray-600 text-white px-4 py-2 focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">New Password</label>
                    <input type="password" name="password" id="password" class="w-full rounded-lg bg-gray-700 border-gray-600 text-white px-4 py-2 focus:outline-none focus:border-blue-500" placeholder="Leave blank to keep current password">
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full rounded-lg bg-gray-700 border-gray-600 text-white px-4 py-2 focus:outline-none focus:border-blue-500">
                </div>
                <div class="pt-4">
                    <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 