<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/customer/profile/view', [UserController::class, 'viewProfile'])->name('profile.view')->middleware('auth');
