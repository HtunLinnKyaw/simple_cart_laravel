<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;







Route::get('/', [CartController::class, 'index']);
Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/view-cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::delete('/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/checkout/save', [CartController::class, 'saveCheckoutDetails'])->name('checkout.save');
