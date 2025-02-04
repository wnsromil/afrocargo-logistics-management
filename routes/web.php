<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Admin\{
    RoleController,
    UserController,
    WarehouseController,
    CustomerController,
    VehicleController,
    WarehouseManagerController,
    DriversController,
    InventoryController
};

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// admin routes
Route::group(['middleware'=>'auth','as'=>'admin.'],function () {

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('warehouses', WarehouseController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('vehicle', VehicleController::class);
    Route::resource('warehouse_manager', WarehouseManagerController::class);
    Route::resource('drivers', DriversController::class);
    Route::resource('inventories', InventoryController::class);
});

require __DIR__.'/auth.php';
