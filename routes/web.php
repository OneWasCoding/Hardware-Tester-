<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemsController;

require __DIR__.'/user.php';
require __DIR__.'/admin.php';

Route::prefix("admin/users")->group(function(){
    Route::get('/index', [UserController::class, "index"])->name("user.index");
    Route::get('/create', [AccountController::class, "create"])->name("user.create");
    Route::post('/store', [AccountController::class, "store"])->name("user.store");
    Route::get('/edit/{id}', [AccountController::class, "edit"])->name("user.edit");
    Route::put('/update/{id}',[AccountController::class,"update"])->name("user.update");
    Route::delete('/destroy/{id}', [AccountController::class, "destroy"])->name("user.destroy"); // Fixed
    Route::post('/update_password/{id}', [AccountController::class, "update_password"])->name("user.update.password");
});


Route::resource('items', ItemsController::class)->names("item");
Route::get('items/restore/{id}', [ItemsController::class, 'restore'])->name('item.restore');


Route::get('/home', [HomeController::class, 'index'])->name('home');



// Route::middleware(['auth'])->group(function () {
//     Route::get('/user/profile', [UserController::class, 'show'])->name('user.show');
//     Route::put('/user/update', [UserController::class, 'update'])->name('user.update');
// });


