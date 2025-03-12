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
    NotificationController,
    AdvanceReportsController
};

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/rolemanagements', function () {
    return view('admin.rolemanagements.index');
});
Route::get('/rolemanagementCreate', function () {
    return view('admin.rolemanagementCreate.create');
});
Route::get('/rolemanagementUpdate', function () {
    return view('admin.rolemanagementUpdate.edit');
});

Route::get('/driversactivitylog', function () {
    return view('admin.driversactivitylog.activitylog');
});

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'authCheck', 'verified'])->name('admin.dashboard');


Route::middleware(['auth', 'authCheck'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/password', [ProfileController::class, 'change'])->name('profile.password');
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
        Route::resource('notification', NotificationController::class);
        Route::resource('warehouses', WarehouseController::class);
        Route::resource('customer', CustomerController::class);
        Route::resource('vehicle', VehicleController::class);
        Route::resource('warehouse_manager', WarehouseManagerController::class);
        Route::resource('drivers', DriversController::class);
        Route::resource('inventories', InventoryController::class);
        Route::resource('advance_reports', AdvanceReportsController::class);
        Route::resource('OrderShipment', OrderShipmentController::class);
        Route::resource('hubs', HubTrackingController::class);
        Route::resource('invoices', InvoiceController::class);
        Route::get('invoices/details/{id}', [InvoiceController::class, 'invoices_details'])->name('invoices.details');
        Route::get('invoices/invoices_download/{id}', [InvoiceController::class, 'invoices_download'])->name('invoices.invoicesdownload');
        Route::get('container', [VehicleController::class, 'container_index'])->name('container.list');
  
        Route::get('transferHub', [HubTrackingController::class, 'transfer_hub'])->name('transfer.hub.list');
        Route::get('receivedHub', [HubTrackingController::class, 'received_hub'])->name('received.hub.list');
        Route::get('receivedOrders', [HubTrackingController::class, 'received_orders'])->name('received.orders.hub.list');

        Route::get('drivers/search', [DriversController::class, 'index'])->name('drivers.search');
        Route::post('drivers/status/{id}', [DriversController::class, 'changeStatus'])->name('drivers.status');
        
        Route::post('vehicle/status/{id}', [VehicleController::class, 'changeStatus'])->name('vehicle.status');

    });
});

require __DIR__.'/auth.php';
