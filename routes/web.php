<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminDashboardController;

use App\Http\Controllers\CouponController;
use App\Http\Controllers\UserController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Admin routes
Route::middleware(['admin'])->group(function () {
    Route::resource('products', ProductController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->except(['store']);
    Route::resource('coupons', CouponController::class);
    Route::post('/coupons', [CouponController::class, 'store'])->name('coupons.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/admin/notifications', function () {
        return view('admin.notifications');
    })->name('admin.notifications');
});

// Public store for categories
Route::post('/categories', [CategoryController::class, 'store'])->middleware('auth')->name('categories.store');

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Auth::routes();

// Authenticated user routes
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

    Route::post('/order', [OrderController::class, 'store'])->name('order.store');

    Route::post('wishlist/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('wishlist/{product}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.applyCoupon');

    Route::post('reviews/{product}', [ReviewController::class, 'store'])->name('reviews.store');

    // Add user profile and orders routes
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/user/orders', [UserController::class, 'orders'])->name('user.orders');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});
