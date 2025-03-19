<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::prefix("admin/users")->group(function(){
Route::get('/index',[UserController::class,"index"])->name("user.index");
Route::get('/create',[AccountController::class,"create"])->name("user.create");
Route::post('/store',[AccountController::class,"store"])->name("user.store");

});
