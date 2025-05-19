@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
<div class="bg-gradient-to-br from-gray-900 to-black min-h-screen py-8">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-white">Notifications</h1>
                <div class="flex space-x-4">
                    <button onclick="markAllAsRead()" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Mark All as Read
                    </button>
                    <button onclick="clearAll()" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Clear All
                    </button>
                </div>
            </div>

            <!-- Notifications List -->
            @if(auth()->user()->notifications->isEmpty())
                <div class="bg-gray-800 rounded-lg shadow-lg p-8 text-center">
                    <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <p class="text-xl text-gray-400">No notifications at the moment</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach(auth()->user()->notifications as $notification)
                        <div class="bg-gray-800 rounded-lg shadow-lg p-6 transform transition-all duration-300 hover:scale-[1.02] hover:shadow-gray-700/50 {{ $notification->read_at ? 'opacity-75' : '' }}">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3">
                                        @if(!$notification->read_at)
                                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                        @endif
                                        <p class="text-white text-lg">{{ $notification->data['message'] ?? 'Notification without message' }}</p>
                                    </div>
                                    <div class="mt-2 flex items-center text-gray-400">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>{{ $notification->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    @if(!$notification->read_at)
                                        <button onclick="markAsRead('{{ $notification->id }}')" class="p-2 text-gray-400 hover:text-white transition-colors duration-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                    @endif
                                    <button onclick="deleteNotification('{{ $notification->id }}')" class="p-2 text-gray-400 hover:text-red-500 transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    function markAsRead(notificationId) {
        // Add your mark as read logic here
        console.log('Mark as read:', notificationId);
    }

    function markAllAsRead() {
        // Add your mark all as read logic here
        console.log('Mark all as read');
    }

    function deleteNotification(notificationId) {
        // Add your delete notification logic here
        console.log('Delete notification:', notificationId);
    }

    function clearAll() {
        // Add your clear all notifications logic here
        console.log('Clear all notifications');
    }
</script>
@endpush
@endsection
