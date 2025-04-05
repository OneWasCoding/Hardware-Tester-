<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});
Route::prefix("admin/users")->group(function(){
    Route::get('/index', [UserController::class, "index"])->name("user.index");
    Route::get('/create', [AccountController::class, "create"])->name("user.create");
    Route::post('/store', [AccountController::class, "store"])->name("user.store");
    Route::get('/edit/{id}', [AccountController::class, "edit"])->name("user.edit");
    Route::put('/update/{id}',[AccountController::class,"update"])->name("user.update");
    Route::delete('/destroy/{id}', [AccountController::class, "destroy"])->name("user.destroy");
    Route::post('/update_password/{id}', [AccountController::class, "update_password"])->name("user.update.password");
});



Route::resource('items', ItemsController::class)->names('item');

