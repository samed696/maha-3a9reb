<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_price');
        $totalUsers = User::count();

        // Sales evolution: daily sales for last 30 days
        $salesDaily = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_price) as total'))
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Sales evolution: weekly sales for last 12 weeks
        $salesWeekly = Order::select(DB::raw('YEARWEEK(created_at) as week'), DB::raw('SUM(total_price) as total'))
            ->where('created_at', '>=', now()->subWeeks(12))
            ->groupBy('week')
            ->orderBy('week')
            ->get();

        // Sales evolution: monthly sales for last 12 months
        $salesMonthly = Order::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('SUM(total_price) as total'))
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Top 5 best selling products
        $topProducts = Product::withCount(['orderItems as total_sold' => function ($query) {
            $query->select(DB::raw('SUM(quantity)'));
        }])->orderByDesc('total_sold')->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'totalUsers',
            'salesDaily',
            'salesWeekly',
            'salesMonthly',
            'topProducts'
        ));
    }

    public function notifications()
    {
        return view('admin.notifications');
    }
}
