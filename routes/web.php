<?php

use App\Livewire\Auth\ForgotPasswordPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\CancelPage;
use App\Livewire\CartPage;
use App\Livewire\CategoriesPage;
use App\Livewire\CheckoutPage;
use App\Livewire\HomePage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\ProductsPage;
use App\Livewire\SuccesssPage; // typo fixed
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', HomePage::class);
Route::get('/categories', CategoriesPage::class);
Route::get('/products', ProductsPage::class);
Route::get('/cart', CartPage::class);
Route::get('/products/{slug}', ProductDetailPage::class);

// Guest-only routes
Route::middleware('guest')->group(function () {
    Route::get('/login', LoginPage::class)->name('login');
    Route::get('/register', RegisterPage::class)->name('register');
    Route::get('/forgot', ForgotPasswordPage::class)->name('password.request');
    Route::get('/reset/{token}', ResetPasswordPage::class)->name('password.reset');
});

// Auth-only routes
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', function () {
        auth::logout();
        return redirect('/');
    })->name('logout');

    // Checkout
    Route::get('/checkout', CheckoutPage::class)->name('checkout');

    // My Orders list
    Route::get('/my-orders', MyOrdersPage::class)->name('myorders.index');

    // My Order details
    Route::get('/my-orders/{order_id}', MyOrderDetailPage::class)->name('myorders.show');

    // Payment success & cancel pages
    Route::get('/success', SuccesssPage::class)->name('success');
    Route::get('/cancel', CancelPage::class)->name('cancel');
});
