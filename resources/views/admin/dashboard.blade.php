@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="bg-gradient-to-br from-gray-900 to-black min-h-screen py-8">
    <div class="container mx-auto px-4">
        <!-- Welcome Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white mb-2">Welcome, {{ auth()->user()->name }}</h1>
            <p class="text-gray-400">Here's an overview of your store's performance</p>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <a href="{{ route('coupons.index') }}" class="bg-gray-800 rounded-lg p-6 hover:bg-gray-700 transition-colors duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-blue-500/10 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Manage Coupons</h3>
                <p class="text-gray-400 text-sm">View and manage discount codes</p>
            </a>

            <a href="{{ route('admin.notifications') }}" class="bg-gray-800 rounded-lg p-6 hover:bg-gray-700 transition-colors duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-green-500/10 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Notifications</h3>
                <p class="text-gray-400 text-sm">View and manage system notifications</p>
            </a>

            <a href="{{ route('admin.orders') }}" class="bg-gray-800 rounded-lg p-6 hover:bg-gray-700 transition-colors duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-purple-500/10 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Manage Orders</h3>
                <p class="text-gray-400 text-sm">Process and track customer orders</p>
            </a>
        </div>

        <!-- Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gray-800 rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-blue-500/10 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Total Orders</h3>
                <p class="text-3xl font-bold text-white">{{ $totalOrders }}</p>
                <p class="text-gray-400 text-sm mt-2">Total number of orders received</p>
            </div>

            <div class="bg-gray-800 rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-green-500/10 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Total Revenue</h3>
                <p class="text-3xl font-bold text-white">${{ number_format($totalRevenue, 2) }}</p>
                <p class="text-gray-400 text-sm mt-2">Total revenue from all orders</p>
</div>

            <div class="bg-gray-800 rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-purple-500/10 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Total Users</h3>
                <p class="text-3xl font-bold text-white">{{ $totalUsers }}</p>
                <p class="text-gray-400 text-sm mt-2">Total registered users</p>
            </div>
        </div>

        <!-- Sales Evolution -->
        <div class="bg-gray-800 rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-white mb-6">Sales Evolution</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Daily Sales -->
                <div class="bg-gray-700/30 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-white mb-4">Daily Sales</h3>
                    <div class="h-64">
                        <canvas id="dailySalesChart"></canvas>
                    </div>
                </div>

                <!-- Weekly Sales -->
                <div class="bg-gray-700/30 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-white mb-4">Weekly Sales</h3>
                    <div class="h-64">
                        <canvas id="weeklySalesChart"></canvas>
                    </div>
                </div>

                <!-- Monthly Sales -->
                <div class="bg-gray-700/30 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-white mb-4">Monthly Sales</h3>
                    <div class="h-64">
                        <canvas id="monthlySalesChart"></canvas>
        </div>
    </div>
            </div>
        </div>

        @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Daily Sales Chart
            new Chart(document.getElementById('dailySalesChart'), {
                type: 'line',
                data: {
                    labels: {!! json_encode($salesDaily->pluck('date')) !!},
                    datasets: [{
                        label: 'Daily Sales',
                        data: {!! json_encode($salesDaily->pluck('total')) !!},
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: '#9CA3AF'
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: '#9CA3AF'
                            }
                        }
                    }
                }
            });

            // Weekly Sales Chart
            new Chart(document.getElementById('weeklySalesChart'), {
                type: 'bar',
                data: {
                    labels: {!! json_encode($salesWeekly->pluck('week')) !!},
                    datasets: [{
                        label: 'Weekly Sales',
                        data: {!! json_encode($salesWeekly->pluck('total')) !!},
                        backgroundColor: '#10B981',
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: '#9CA3AF'
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: '#9CA3AF'
                            }
                        }
                    }
                }
            });

            // Monthly Sales Chart
            new Chart(document.getElementById('monthlySalesChart'), {
                type: 'line',
                data: {
                    labels: {!! json_encode($salesMonthly->pluck('month')) !!},
                    datasets: [{
                        label: 'Monthly Sales',
                        data: {!! json_encode($salesMonthly->pluck('total')) !!},
                        borderColor: '#8B5CF6',
                        backgroundColor: 'rgba(139, 92, 246, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: '#9CA3AF'
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: '#9CA3AF'
                            }
                        }
                    }
                }
            });
        </script>
        @endpush

        <!-- Top Products -->
        <div class="bg-gray-800 rounded-lg p-6">
            <h2 class="text-xl font-semibold text-white mb-6">Top Selling Products</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-400 text-sm">
                            <th class="pb-4">Product</th>
                            <th class="pb-4">Price</th>
                            <th class="pb-4">Total Sold</th>
                            <th class="pb-4">Revenue</th>
                        </tr>
                    </thead>
                    <tbody class="text-white">
                        @forelse($topProducts as $product)
                            <tr class="border-t border-gray-700">
                                <td class="py-4">{{ $product->name }}</td>
                                <td class="py-4">${{ number_format($product->price, 2) }}</td>
                                <td class="py-4">{{ $product->total_sold }}</td>
                                <td class="py-4">${{ number_format($product->price * $product->total_sold, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-gray-400 py-4">No products found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
