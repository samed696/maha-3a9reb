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
        $orders = $user->orders()->with(['items.product'])->latest()->get();
        $reviews = $user->reviews()->with('product')->latest()->get();
        
        return view('user.profile', compact('user', 'orders', 'reviews'));
    }

    // Show user orders page
    public function orders()
    {
        $orders = Auth::user()->orders()->with(['items.product'])->latest()->paginate(10);
        return view('user.orders', compact('orders'));
    }

    // Show user settings page
    public function settings()
    {
        $user = Auth::user();
        return view('user.settings', compact('user'));
    }

    // Update user settings
    public function updateSettings(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('user.settings')->with('success', 'Settings updated successfully.');
    }
}
