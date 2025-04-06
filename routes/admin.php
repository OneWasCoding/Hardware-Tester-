<?php 
use Illuminate\Support\Facades\Route;;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ItemsController;

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

?>