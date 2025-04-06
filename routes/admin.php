<?php 

use Illuminate\Support\Facades\Auth;
use App\Http\middleware\Admin;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\OrdersController;
use Illuminate\Auth\Events\Login;


Route::prefix("admin/users")->group(function(){
    route::get('/',[LoginController::class,"authenticated_admin"],function(){
        return redirect()->route('user.index');
    })->name("admin.users")->middleware(Admin::class);
    Route::get('/index', [UserController::class, "index"])->name("user.index")->middleware(Admin::class);
    Route::get('/create', [AccountController::class, "create"])->name("user.create")->middleware(Admin::class);
    Route::post('/store', [AccountController::class, "store"])->name("user.store")->middleware(Admin::class);
    Route::get('/edit/{id}', [AccountController::class, "edit"])->name("user.edit")->middleware(Admin::class);
    Route::put('/update/{id}',[AccountController::class,"update"])->name("user.update");
    Route::delete('/destroy/{id}', [AccountController::class, "destroy"])->name("user.destroy")->middleware(Admin::class); // Fixed
    Route::post('/update_password/{id}', [AccountController::class, "update_password"])->name("user.update.password")->middleware(Admin::class);
});
Auth::routes();

Route::resource('items', ItemsController::class)->names("item");
Route::post('item/import', [ItemsController::class, 'import'])->name('item.import')->middleware(Admin::class);
Route::get('items/restore/{id}', [ItemsController::class, 'restore'])->name('item.restore');

Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index')->middleware(Admin::class);
Route::get('/order_status/{id}', [OrdersController::class, 'status_update'])->name('orders.status')->middleware(Admin::class);

?>