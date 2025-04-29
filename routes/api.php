<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    RegisterController,
    ForgetPassword,
    ProfileController,
    CommonController,
    NotificationController,
    SubcategoryController,
    CustomerController,
    ContainerController,
    AddressController,
    CartController,
    InvoiceController,
    WarehouseController,
    SlotController,
    SettingController,
    AvailabilityController,
    WeeklySchedulesController,
    InventoryController,
    ScheduleController,
    ExpensesController,
    DriverInventoryController,
    DashboardController,
    ServiceOrderStatusManage
};
use App\Http\Controllers\Api\{
    LocationController,
    OrderShipmentController,
    ProductController
};

use App\Http\Controllers\Web\Admin\{
    OrderStatusManage,
};
// Route::get('/user', function (Request $request) {
//     return $request->user()->load('warehouse');
// })->middleware('auth:api');

//country city state api's
Route::get('/get-countries', [LocationController::class, 'getCountries']);
Route::get('/get-states/{country_id}', [LocationController::class, 'getStates']);
Route::get('/get-cities/{state_id}', [LocationController::class, 'getCities']);

Route::get('/get-terms-conditions', [CommonController::class, 'getTermsConditions']);
Route::get('/get-privacy-policies', [CommonController::class, 'getPrivacyPolicies']);
Route::get('/get-about-us', [CommonController::class, 'getAboutUs']);

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
Route::post('forgetPassword', [ForgetPassword::class, 'forgetPassword']);
Route::post('/warehouse-list', [WarehouseController::class, 'index']);
Route::post('/estimatPrice', [OrderShipmentController::class, 'estimatPrice']);

Route::post('/vehicle/toggle-status', [ContainerController::class, 'toggleStatus']);
Route::get('/vehicle/getAdminActiveContainer', [ContainerController::class, 'getAdminActiveContainers']);
Route::get('/user-by-warehouse/{warehouse_id}', [CustomerController::class, 'getUsersByWarehouse']);
Route::get('/container-by-warehouse/{warehouse_id}', [CustomerController::class, 'getVehiclesByWarehouse']);
Route::get('/dashboard-stats', [DashboardController::class, 'getDashboardStats']);


//Order Status Manage Apis
Route::post('/get-drivers-by-assign-status', [OrderStatusManage::class, 'getDriversByParcelId']);
Route::post(uri: '/update-status-pick-up-with-driver', action: [OrderStatusManage::class, 'statusUpdate_PickUpWithDriver']);
Route::post(uri: '/update-status-arrived-warehouse', action: [OrderStatusManage::class, 'statusUpdate_ArrivedWarehouse']);


Route::middleware('auth:api')->group(function () {
    Route::post('logout', [RegisterController::class, 'logout']);
    Route::post('verifyOtp', [RegisterController::class, 'verifyOtp']);
    Route::post('resendOtp', [RegisterController::class, 'resendOtp']);
    Route::post('resetPassword', [ForgetPassword::class, 'resetPassword']);

    Route::get('/available-slots', [SlotController::class, 'getAvailableSlots']);
    Route::post('/book-slot', [SlotController::class, 'bookSlot']);
    Route::get('/booked-slots', [SlotController::class, 'getBookedSlots']);
    Route::delete('/cancel-booking', [SlotController::class, 'cancelBooking']);

    Route::prefix('settings')->group(function () {
        Route::get('/project', [SettingController::class, 'getProjectSettings']);
        Route::post('/global', [SettingController::class, 'updateGlobalSettings']);
        Route::post('/project', [SettingController::class, 'updateProjectSettings']);
    });

    Route::apiResource('availabilities', AvailabilityController::class);
    Route::apiResource('weekly-schedules', WeeklySchedulesController::class);



    Route::middleware(['apiAuthCheck'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'profile']);
        Route::post('profileUpdate', [ProfileController::class, 'update']);
        Route::post('profilePictureUpdate', [ProfileController::class, 'updateProfilePicture']);
        Route::apiResource('OrderShipment', OrderShipmentController::class);
        Route::put('OrderShipmentStatus', [OrderShipmentController::class, 'OrderShipmentStatus']);
        Route::get('OrderHistory/{id}', [OrderShipmentController::class, 'OrderHistory']);
        Route::get('inventoryOrderCategories', [OrderShipmentController::class, 'inventoryOrderCategories']);
        Route::post('changePassword', [ProfileController::class, 'changePassword']);
        Route::get('/get-notification', [NotificationController::class, 'getNotifications']);
        Route::get('/get-subcategories/{category_id}', [SubcategoryController::class, 'getSubcategoriesByCategoryId']);
        Route::get('/categories-item/{id}', [OrderShipmentController::class, 'getParcelDetailsById']);
        Route::post('/update-driver-parcel', [OrderShipmentController::class, 'updateDriverParcel']);

        Route::get('/customers-details/{id}', [CustomerController::class, 'getCustomersDetails']);
        Route::get('/customers-list', [CustomerController::class, 'getCustomers']);

        Route::post('/create-customer', [CustomerController::class, 'createCustomer']);
        Route::post('/create-shipping-customer', [CustomerController::class, 'createShippingCustomer']);
        Route::get('/shipping-customer-list/{id}', [CustomerController::class, 'ShippingCustomerList']);
        // Container Routes
        Route::get('/container-list', [ContainerController::class, 'getActiveContainers']);
        Route::apiResource('cart', CartController::class);
        Route::post('/productList', [CartController::class, 'productList']);
        Route::post('/delete-product', [CartController::class, 'destroyProduct']);

        // Addresse Routes
        Route::post('/address-list', [AddressController::class, 'getAddress']);
        Route::post('/addresse-create', [AddressController::class, 'createAddress']);
        Route::get('/addresse-delete/{id}', [AddressController::class, 'deleteAddress']);
        Route::post('/address-update/{id}', [AddressController::class, 'updateAddress']);

        // item Routes
        Route::get('/get-items', [InventoryController::class, 'getItems']);

        // Order shipment Routes
        Route::post('/invoice-order-create-service', [OrderShipmentController::class, 'invoiceOrderCreateService']);
        Route::post('/invoice-order-create-supply', [OrderShipmentController::class, 'invoiceOrderCreateSupply']);
        Route::post('/order-create-supply', [OrderShipmentController::class, 'storeSupply']);

        // Available slots Routes
        Route::post('/get-available-slots', [ScheduleController::class, 'getAvailableSlots']);

        // Expenses
        Route::post('/add-expenses', [ExpensesController::class, 'store']);
        Route::post('/update-expenses/{id}', [ExpensesController::class, 'update']);
        Route::get('/get-expenses', [ExpensesController::class, 'getExpensesByUser']);

        // Driver Inventory
        Route::get('/get-driver-inventory', [DriverInventoryController::class, 'getDriverInventorySolde']);
    
       // Schedule apis
       Route::post('/location-store', [AvailabilityController::class, 'locationStore']);
  
      // Service Order Status Manage Driver
        Route::post('/get-driver-service-orders-list', [ServiceOrderStatusManage::class, 'getDriverServiceOrders']);
        Route::get('/get-driver-service-orders-details/{id}', [ServiceOrderStatusManage::class, 'getDriverServiceOrderDetails']);
        Route::post('/update-status-pick-up', [ServiceOrderStatusManage::class, 'statusUpdate_PickUp']);
    
    });

    //invoice controller
    Route::group(['middleware' => 'apiAuthCheck', 'controller' => InvoiceController::class], function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::post('/store', 'store');
        Route::get('/supply', 'inventaries');
        Route::get('/invoice-details/{id}', 'invoiceDetails');
        Route::get('/invoice-get/{type}', 'invoicesGet');
    });
});
