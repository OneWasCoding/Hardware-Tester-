<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemsController;

Route::get('/customer/profile/view', [UserController::class, 'viewProfile'])->name('profile.view')->middleware('user');
Route::get('/customer/profile/edit', [UserController::class, 'edit'])->name('profile.edit')->middleware('user');
Route::put('/customer/profile/update', [UserController::class, 'update'])->name('profile.update')->middleware('user');

Auth::routes();


Route::prefix('customer/cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index')->middleware('user');
    Route::post('/add/{itemId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::put('/update/{cartId}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('user');

Route::get('/item/{item_id}', [CartController::class, 'showItem'])->name('item.view');
Route::delete('/cart/{cart_id}', [CartController::class, 'destroy'])->name('cart.delete')->middleware(`auth`);

