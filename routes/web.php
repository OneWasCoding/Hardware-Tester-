<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ItemsController;


Route::get('/', function () {
    return view('welcome');
});
Route::prefix("admin/users")->group(function(){
    Route::get('/index', [UserController::class, "index"])->name("user.index");
    Route::get('/create', [AccountController::class, "create"])->name("user.create");
    Route::post('/store', [AccountController::class, "store"])->name("user.store");
    Route::get('/edit/{id}', [AccountController::class, "edit"])->name("user.edit");
    Route::put('/update/{id}',[AccountController::class,"update"])->name("user.update");
    Route::delete('/destroy/{id}', [AccountController::class, "destroy"])->name("user.destroy"); // Fixed
});


Route::resource('items', ItemsController::class)->names("item");
Route::get('items/restore/{id}', [ItemsController::class, 'restore'])->name('item.restore');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
