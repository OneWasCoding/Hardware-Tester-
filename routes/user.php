<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;

Route::get('/customer/profile/view', [UserController::class, 'viewProfile'])->name('profile.view')->middleware('auth');
Route::get('/customer/profile/edit', [UserController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::put('/customer/profile/update', [UserController::class, 'update'])->name('profile.update')->middleware('auth');

Auth::routes();


Route::prefix('customer/cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index')->middleware('auth');
    Route::post('/add/{itemId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::put('/update/{cartId}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});