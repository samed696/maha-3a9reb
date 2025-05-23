<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;
use Illuminate\Support\Facades\Session;

// ...
class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $appliedCoupon = session()->get('coupon'); // unify session key usage

        // Calculate subtotal
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // Calculate discount
        $discount = 0;
        if ($appliedCoupon) {
            if ($appliedCoupon['type'] === 'fixed') {
                $discount = $appliedCoupon['value'];
            } elseif ($appliedCoupon['type'] === 'percent') {
                $discount = ($appliedCoupon['value'] / 100) * $subtotal;
            }
        }

        // Calculate total after discount
        $total = $subtotal - $discount;

        return view('cart.index', compact('cart', 'appliedCoupon', 'subtotal', 'discount', 'total'));
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index')->with('success', 'Produit retiré du panier');
    }


public function applyCoupon(Request $request)
{
    $request->validate([
        'coupon_code' => 'required|string'
    ]);

    $coupon = Coupon::where('code', $request->coupon_code)->first();

    if (!$coupon) {
        return back()->with('error', 'Coupon not found.');
    }

    if ($coupon->expiry_date && now()->gt($coupon->expiry_date)) {
        return back()->with('error', 'Coupon expired.');
    }

    // Save coupon to session
    Session::put('coupon', [
        'code' => $coupon->code,
        'type' => $coupon->type,
        'value' => $coupon->value
    ]);

    return back()->with('success', 'Coupon applied successfully!');
}

}
