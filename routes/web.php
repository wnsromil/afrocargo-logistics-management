<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserPermissionController;
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
    BillofLadingController,
    LadingDetailsController,
    CBMCalculatoarController,
    CustomReportController,
    VerifyLicenseController,
    SupplyInventoryController,
    OrderStatusManage,
    EODController,
    PaymentTransactionController,
    RewardController
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

Route::get('/lading_details_PDF', function () {
    return view('admin.lading_details_PDF.bill-pdf');
});

Route::get('/customReport', function () {
    return view('admin.customReport.index');
});

Route::get('/customReportEdit', function () {
    return view('admin.customReportEdit.edit');
});

Route::get('/customReport_pdf1', function () {
    return view('admin.customReport_pdf1.item_product_list');
});

Route::get('/customReport_pdf_2', function () {
    return view('admin.customReport_pdf_2.containerReportList');
});

Route::get('/VerifyLicense', function () {
    return view('admin.VerifyLicense.index');
});


Route::get('/state-city-insert', [AutoCallBatchController::class, 'insertStatesAndCities'])->name('admin.insertStatesAndCities');

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
        Route::resource('supply_inventories', SupplyInventoryController::class);
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
        Route::resource('custom-reports', CustomReportController::class);
        Route::post('updateCustomReportContainer', [CustomReportController::class, 'updateCustomReportContainer'])->name('custom-reports.updateCustomReportContainer');
        Route::resource('verify-license', VerifyLicenseController::class);

        Route::resource('template_category', TemplateCategoryController::class);
        Route::resource('templates', TemplateController::class);
        Route::resource('autocall', AutoCallBatchController::class);
        Route::resource('bill_of_lading', BillofLadingController::class);
        Route::resource('lading_details', LadingDetailsController::class);
        Route::resource('end_of_day', EODController::class);
        Route::resource('payment_transaction', PaymentTransactionController::class);
        Route::resource('reward_point', RewardController::class);


        // EOD
        Route::get('invoice-index', [EODController::class, 'Invoice_index'])->name('end_of_day.Invoice_index');
        Route::get('supply-index', [EODController::class, 'Supply_index'])->name('end_of_day.Supply_index');
        Route::get('payments-index', [EODController::class, 'Payments_index'])->name('end_of_day.Payments_index');
        Route::get('expenses-index', [EODController::class, 'Expenses_index'])->name('end_of_day.Expenses_index');
        Route::get('void-index', [EODController::class, 'Void_index'])->name('end_of_day.Void_index');
        Route::get('deposit-index', [EODController::class, 'Deposit_index'])->name('end_of_day.Deposit_index');
        Route::get('print-index', [EODController::class, 'Print_index'])->name('end_of_day.Print_index');


        Route::get('bill-of-ladings/{id}', [LadingDetailsController::class, 'billOfLading'])->name('bill_of_lading.billOfLading');
        Route::get('invoices/details/{id}', [InvoiceController::class, 'invoices_details'])->name('invoices.details');
        Route::get('customerSearch', [InvoiceController::class, 'customerSearch'])->name('customerSearch');
        Route::get('getOrderList', [InvoiceController::class, 'getOrderList'])->name('getOrderList');
        Route::post('saveInvoceCustomer', [InvoiceController::class, 'saveInvoceCustomer'])->name('saveInvoceCustomer');
        Route::post('saveIndividualPayment', [InvoiceController::class, 'saveIndividualPayment'])->name('saveIndividualPayment');
        Route::post('updateNote', [InvoiceController::class, 'updateNote'])->name('invoice.updateNote');
        Route::post('updateClaim', [InvoiceController::class, 'updateClaim'])->name('invoice.updateClaim');
        Route::get('invoices/trashed/list', [InvoiceController::class, 'trashed'])->name('invoice.trashed');
        Route::get('invoices/restore/{id}', [InvoiceController::class, 'restore'])->name('invoice.restore');
        Route::delete('invoices/delete/{id}', [InvoiceController::class, 'delete'])->name('invoice.delete');
        Route::post('/invoice-create-order-details-service', [InvoiceController::class, 'orderDetailsCreateInvoice']);

        Route::get('transferHub', [HubTrackingController::class, 'transfer_hub'])->name('transfer.hub.list');
        Route::get('receivedHub', [HubTrackingController::class, 'received_hub'])->name('received.hub.list');
        Route::get('transferHub-history', [HubTrackingController::class, 'transfer_history_hub'])->name('transfer.hub.history.list');
        Route::get('receivedHub-history', [HubTrackingController::class, 'received_history_hub'])->name('received.hub.history.list');

        Route::get('receivedOrders', [HubTrackingController::class, 'received_orders'])->name('received.orders.hub.list');
        Route::get('receivedOrders/{id}', [HubTrackingController::class, 'received_orders_show'])->name('received.received_orders_show');
        Route::get('container_order/{id}/{type}', [HubTrackingController::class, 'container_order'])->name('container.orders.percel.list');

        Route::get('drivers/search', [DriversController::class, 'index'])->name('drivers.search');
        Route::post('drivers/status/{id}', [DriversController::class, 'changeStatus'])->name('drivers.status');
        Route::get('drivers/schedule/{id}', action: [DriversController::class, 'schedule'])->name('drivers.schedule');
        Route::get('drivers/schedule-show/{id}', [DriversController::class, 'scheduleshow'])->name('drivers.scheduleshow');
        Route::get('drivers/schedule_destroy/{id}', [DriversController::class, 'scheduleDestroy'])->name('drivers.schedule.delete');
        Route::post('vehicle/status/{id}', [VehicleController::class, 'changeStatus'])->name('vehicle.status');

        // Customer
        Route::post('customer/status/{id}', [CustomerController::class, 'changeStatus'])->name('customer.status');

        // Customer Ship To
        Route::get('customer-shipTo', [CustomerController::class, 'ShipTo_index'])->name('customer.shipToIndex');

        // Customer Ship To Address
        Route::get('/view-shipTo/{id}', [CustomerController::class, 'viewShipTo'])->name('customer.viewShipTo');
        Route::post('/create-shipTo', [CustomerController::class, 'createShipTo'])->name('customer.createShipTo');
        Route::get('/update-shipTo/{id}', [CustomerController::class, 'updateShipTo'])->name('customer.updateShipTo');
        Route::put('/edit-shipTo/{id}', [CustomerController::class, 'editeShipTo'])->name('customer.editeShipTo');
        Route::post('/delete-shipTo/{id}', [CustomerController::class, 'destroyShipTo'])->name('customer.destroyShipTo');

        // Customer Pickups Address
        Route::get('/view-viewPickups/{id}', [CustomerController::class, 'viewPickups'])->name('customer.viewPickups');
        Route::get('/view-viewPickupAddress/{id}', [CustomerController::class, 'viewPickupAddress'])->name('customer.viewPickupAddress');
        Route::post('/create-pickupAddress', [CustomerController::class, 'createPickupAddress'])->name('customer.createPickupAddress');
        Route::get('/update-pickupAddress/{id}', [CustomerController::class, 'updatePickupAddress'])->name('customer.updatePickupAddress');
        Route::put('/edit-editpickupAddress/{id}', [CustomerController::class, 'editPickupAddress'])->name('customer.editPickupAddress');
        Route::post('/delete-pickupAddress/{id}', [CustomerController::class, 'destroyPickupAddress'])->name('customer.destroyPickupAddress');

        // Customer Pickups
        Route::post('/create-Pickup', [CustomerController::class, 'Pickupstore'])->name('customer.Pickupstore');
        Route::get('/update-Pickup/{id}', [CustomerController::class, 'updatePickup'])->name('customer.updatePickup');
        Route::post('/edit-Pickup/{id}', [CustomerController::class, 'Editupdate'])->name('customer.pickup-edit');

        // Warehouse
        Route::post('warehouses/status/{id}', [WarehouseController::class, 'changeStatus'])->name('warehouses.status');

        // Warehouse manager
        Route::post('warehouse_manager/status/{id}', [WarehouseManagerController::class, 'changeStatus'])->name('warehouse_manager.status');

        // Schedule
        Route::post('weekly_schedule_store', [ScheduleController::class, 'weeklyScheduleStore'])->name('schedule.weeklyschedulestore');
        Route::post('location_schedule_store', [ScheduleController::class, 'locationStore'])->name('schedule.locationstore');

        //Expenses
        Route::post('expenses/status/{id}', [ExpensesController::class, 'changeStatus'])->name('expenses.status');

        Route::get('user_role', [RoleManagementController::class, 'index'])->name('user_role.index');
        Route::get('user_role/create', [RoleManagementController::class, 'create'])->name('user_role.create');
        Route::post('user_role/store', [RoleManagementController::class, 'store'])->name('user_role.store');
        //CBM Calculatoar
        Route::get('freight-Calculator', [CBMCalculatoarController::class, 'FreightCalculator'])->name('cbm_calculator.freight_Calculator');
        Route::get('Freight-ContainerSize', [CBMCalculatoarController::class, 'FreightContainerSize'])->name('cbm_calculator.freight_ContainerSize');
        Route::get('freight-Shipping', [CBMCalculatoarController::class, 'FreightShipping'])->name('cbm_calculator.freight_Shipping');
        Route::get('freight-Shipping_PDF', [CBMCalculatoarController::class, 'FreightShipping_PDF'])->name('cbm_calculator.freight_Shipping_PDF');
        Route::post('/container-sizes/update', [CBMCalculatoarController::class, 'ContainerSizeStore'])->name('cbm_calculator.container-sizes.update');
        Route::post('/store-port-freight', [CBMCalculatoarController::class, 'storePortFreight'])->name('cbm_calculator.store-port-freight');

        // Customer
        Route::post('signature/status/{id}', [SignatureController::class, 'changeSignatureStatus'])->name('signature.status');
        Route::post('/statusUpdate_self', [OrderStatusManage::class, 'statusUpdate_self'])->name('statusUpdate_self');

        // Notification
        Route::post('notification_schedule/warehouseManagerStore', [NotificationScheduleController::class, 'warehouseManagerStore'])->name('notification_schedule.warehouseManagerStore');
        Route::post('notification_schedule/DriverStore', [NotificationScheduleController::class, 'DriverStore'])->name('notification_schedule.DriverStore');
        Route::post('notification_schedule/CustomerStore', [NotificationScheduleController::class, 'CustomerStore'])->name('notification_schedule.CustomerStore');

        //

        Route::get('/admin/advance-reports/export', [AdvanceReportsController::class, 'exportReports'])->name('advance.reports.export');


        Route::get('/orderdetails', function () {
            return view('admin.OrderShipment.orderdetails');
        })->name('orderdetails');
        Route::get('/serviceorderdetails', function () {
            return view('admin.serviceorderdetails.orderdetails');
        })->name('serviceorderdetails.orderdetails');



        Route::get('/add-role', function () {
            return view('admin.user_role.create');
        })->name('create');
    });
});

// routes/web.php
Route::prefix('users/{user}/permissions')->group(function () {
    Route::get('edit', [RoleManagementController::class, 'edit'])->name('user-permissions.edit');
    Route::put('update', [RoleManagementController::class, 'update'])->name('user-permissions.update');
});

require __DIR__ . '/auth.php';
