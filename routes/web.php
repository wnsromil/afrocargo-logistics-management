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
    InventoryController,
    OrderShipmentController,
    HubTrackingController,
    InvoiceController,
};

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'authCheck', 'verified'])->name('admin.dashboard');


Route::middleware(['auth', 'authCheck'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile', [ProfileController::class, 'uploadProfilePic'])->name('profile.upload_pic');
    Route::post('/status_update', [OrderShipmentController::class, 'status_update'])->name('parcel.status_update');
});

// admin routes
Route::group(['middleware'=>'auth','as'=>'admin.'],function () {

    Route::middleware('authCheck')->group(function(){

        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
        Route::resource('warehouses', WarehouseController::class);
        Route::resource('customer', CustomerController::class);
        Route::resource('vehicle', VehicleController::class);
        Route::resource('warehouse_manager', WarehouseManagerController::class);
        Route::resource('drivers', DriversController::class);
        Route::resource('inventories', InventoryController::class);
        Route::resource('OrderShipment', OrderShipmentController::class);
        Route::resource('hubs', HubTrackingController::class);
        Route::resource('invoices', InvoiceController::class);
        Route::get('invoices/details/{id}', [InvoiceController::class, 'invoices_details'])->name('invoices.details');

    });
});

require __DIR__.'/auth.php';
