<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\DashboardController;
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
    AdvanceReportsController,
    DriverInventoryController,
    ServiceOrdersController,
    SupplyOrdersController,
    ExpensesController,
    SignatureController,
    NotificationScheduleController,
    RoleManagementController,
    ContainerController,
    TemplateCategoryController,
    TemplateController,
    AutoCallBatchController,
    ScheduleController,
};
use App\Mail\RegistorMail;

Route::group(['middleware' => 'auth'], function () {

    Route::middleware('authCheck')->group(function () {

        Route::get('/seed/{class?}', function ($class = null) {
            $command = 'db:seed';

            if ($class) {
                $command .= " --class=$class";
            }

            Artisan::call($command, ['--force' => true]);

            return response()->json([
                'message' => $class ? "$class seeding completed successfully!" : 'Database seeding completed!',
            ]);
        });

        // Run Migrations (Optional Path)
        Route::get('/migrate/{path?}', function ($path = null) {
            $command = 'migrate';

            if ($path) {
                $command .= " --path=database/migrations/$path";
            }

            Artisan::call($command, ['--force' => true]);

            return response()->json([
                'message' => $path ? "Migration for $path ran successfully!" : 'All migrations ran successfully!',
            ]);
        });

        // Rollback Migrations (Optional Path)
        Route::get('/migrate-rollback/{path?}', function ($path = null) {
            $command = 'migrate:rollback';

            if ($path) {
                $command .= " --path=database/migrations/$path";
            }

            Artisan::call($command, ['--force' => true]);

            return response()->json([
                'message' => $path ? "Rollback for $path completed!" : 'Last batch of migrations rolled back!',
            ]);
        });
    });
});


Route::get('/send', function () {
    Mail::to('krishnapawarwns@gmail.com')->send(new  RegistorMail());
    return [
        'message' => 'Welcome to this api',
    ];
});

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/customeruser', function () {
    return view('admin.customeruser.user');
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

Route::get('/driverschedule', function () {
    return view('admin.driverschedule.schedule');
});

Route::get('/driverinventory', function () {
    return view('admin.driverinventory.index');
});
Route::get('/notificationsend', function () {
    return view('admin.notificationsend.create');
});


Route::get('/', function () {
    return view('auth.login');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'authCheck', 'verified'])->name('admin.dashboard');


Route::middleware(['auth', 'authCheck'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/password', [ProfileController::class, 'change'])->name('profile.password');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile', [ProfileController::class, 'uploadProfilePic'])->name('profile.upload_pic');
    Route::post('/status_update', [OrderShipmentController::class, 'status_update'])->name('parcel.status_update');
});

// admin routes
Route::group(['middleware' => 'auth', 'as' => 'admin.'], function () {

    Route::middleware('authCheck')->group(function () {
        Route::get('/delete-customers/{id}', [CustomerController::class, 'deleteCustomer']);
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
        Route::resource('notification', NotificationController::class);
        Route::resource('warehouses', WarehouseController::class);
        Route::resource('customer', CustomerController::class);
        Route::resource('vehicle', VehicleController::class);
        Route::resource('container', ContainerController::class);
        Route::resource('warehouse_manager', WarehouseManagerController::class);
        Route::resource('drivers', DriversController::class);
        Route::resource('schedules', ScheduleController::class);
        Route::resource('inventories', InventoryController::class);
        Route::resource('advance_reports', AdvanceReportsController::class);
        Route::resource('OrderShipment', OrderShipmentController::class);
        Route::resource('hubs', HubTrackingController::class);
        Route::resource('invoices', InvoiceController::class);
        Route::resource('driver_inventory', DriverInventoryController::class);
        Route::resource('service_orders', ServiceOrdersController::class);
        Route::resource('supply_orders', SupplyOrdersController::class);
        Route::resource('expenses', ExpensesController::class);
        Route::resource('signature', SignatureController::class);
        Route::resource('notification_schedule', NotificationScheduleController::class);
        Route::resource('user_role', RoleManagementController::class);
        Route::resource('template_category', TemplateCategoryController::class);
        Route::resource('templates', TemplateController::class);
        Route::resource('autocall', AutoCallBatchController::class);

        Route::get('invoices/details/{id}', [InvoiceController::class, 'invoices_details'])->name('invoices.details');
        Route::get('invoices/invoices_download/{id}', [InvoiceController::class, 'invoices_download'])->name('invoices.invoicesdownload');
        Route::get('customerSearch', [InvoiceController::class, 'customerSearch'])->name('customerSearch');
        Route::post('saveInvoceCustomer', [InvoiceController::class, 'saveInvoceCustomer'])->name('saveInvoceCustomer');
        Route::post('saveIndividualPayment', [InvoiceController::class, 'saveIndividualPayment'])->name('saveIndividualPayment');
        Route::post('updateNote', [InvoiceController::class, 'updateNote'])->name('updateNote');

        Route::get('transferHub', [HubTrackingController::class, 'transfer_hub'])->name('transfer.hub.list');
        Route::get('receivedHub', [HubTrackingController::class, 'received_hub'])->name('received.hub.list');
        Route::get('receivedOrders', [HubTrackingController::class, 'received_orders'])->name('received.orders.hub.list');

        Route::get('drivers/search', [DriversController::class, 'index'])->name('drivers.search');
        Route::post('drivers/status/{id}', [DriversController::class, 'changeStatus'])->name('drivers.status');
        Route::get('drivers/schedule/{id}', action: [DriversController::class, 'schedule'])->name('drivers.schedule');
        Route::get('drivers/schedule-show/{id}', [DriversController::class, 'scheduleshow'])->name('drivers.scheduleshow');
        Route::get('drivers/schedule_destroy/{id}', [DriversController::class, 'scheduleDestroy'])->name('drivers.schedule.destroy');
        Route::post('vehicle/status/{id}', [VehicleController::class, 'changeStatus'])->name('vehicle.status');



        // Customer 
        Route::post('customer/status/{id}', [CustomerController::class, 'changeStatus'])->name('customer.status');
        Route::get('/view-shipTo/{id}', [CustomerController::class, 'viewShipTo'])->name('customer.viewShipTo');
        Route::post('/create-shipTo', [CustomerController::class, 'createShipTo'])->name('customer.createShipTo');
        Route::get('/update-shipTo/{id}', [CustomerController::class, 'updateShipTo'])->name('customer.updateShipTo');
        Route::put('/edit-shipTo/{id}', [CustomerController::class, 'editeShipTo'])->name('customer.editeShipTo');
        Route::get('/delete-shipTo/{id}', [CustomerController::class, 'destroyShipTo'])->name('customer.updateShipTo');

        // Warehouse 
        Route::post('warehouses/status/{id}', [WarehouseController::class, 'changeStatus'])->name('warehouses.status');

        // Warehouse manager 
        Route::post('warehouse_manager/status/{id}', [WarehouseManagerController::class, 'changeStatus'])->name('warehouse_manager.status');

        // Schedule
        Route::post('weekly_schedule_store', [ScheduleController::class, 'weeklyScheduleStore'])->name('schedule.weeklyschedulestore');
        Route::post('location_schedule_store', [ScheduleController::class, 'locationStore'])->name('schedule.locationstore');

        //Expenses
        Route::post('expenses/status/{id}', [ExpensesController::class, 'changeStatus'])->name('expenses.status');


        Route::get('/orderdetails', function () {
            return view('admin.OrderShipment.orderdetails');
        })->name('orderdetails');
        Route::get('/serviceorderdetails', function () {
            return view('admin.serviceorderdetails.orderdetails');
        })->name('serviceorderdetails.orderdetails');

        Route::get('/container/{id}', function () {
            return view('admin.container.show');
        })->name('container.show');

        Route::get('/add-pickups', function () {
            return view('admin.customer.addPickups');
        })->name('addPickups');

        Route::get('/add-pickups', function () {
            return view('admin.customer.addPickups');
        })->name('addPickups');
    });
});

require __DIR__ . '/auth.php';
