<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function store()
    {
        $cart = session()->get('cart', []);

        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Le panier est vide');
        }

        // Calculate subtotal
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // Apply coupon discount if exists
        $discount = 0;
        if (session('coupon')) {
            $coupon = session('coupon');
            if ($coupon['type'] === 'fixed') {
                $discount = $coupon['value'];
            } elseif ($coupon['type'] === 'percent') {
                $discount = ($coupon['value'] / 100) * $subtotal;
            }
        }

        // Calculate final total
        $total = $subtotal - $discount;

        // Create the order
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $total,
            'discount_amount' => $discount,
            'status' => 'completed'
        ]);

        // Insert order items
        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }

        // Clear cart and applied coupon
        session()->forget(['cart', 'applied_coupon']);

        return redirect()->route('cart.index')->with('success', 'Commande passée !');
    }

    public function show(Order $order)
    {
        // Ensure the authenticated user owns the order
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Load order items and related product details
        $order->load('items.product');

        return view('orders.show', compact('order'));
    }
}
