<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Show user profile page
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    // Show user orders page
    public function orders()
    {
        $user = Auth::user();
        // Assuming you have an Order model and relationship set up
        $orders = $user->orders()->latest()->get();
        return view('user.orders', compact('orders'));
    }
}
