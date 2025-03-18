<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;


Route::get('/', function () {
    return view('welcome');
});

Route::prefix("user")->group(function(){

Route::get('create',[AccountController::class,"create"])->name("user.create");
Route::post('/store',[AccountController::class,"store"])->name("user.store");

});