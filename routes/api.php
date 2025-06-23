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
    ServiceOrderStatusManage,
    PickupController,
    ShiptoController,
    LocationController,
    OrderShipmentController,
    ProductController
};

use App\Http\Controllers\Web\Admin\{
    OrderStatusManage,
    CBMCalculatoarController
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
Route::get('/country-by-name', [CommonController::class, 'getCountryByName']);

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
Route::post('forgetPassword', [ForgetPassword::class, 'forgetPassword']);
Route::post('/warehouse-list', [WarehouseController::class, 'index']);
Route::get('/warehouse-countries', [WarehouseController::class, 'getWarehouseCountries']);
Route::post('/estimatPrice', [OrderShipmentController::class, 'estimatPrice']);

Route::post('/vehicle/toggle-status', [ContainerController::class, 'toggleStatus']);
Route::post('/vehicle/getAdminActiveContainer', [ContainerController::class, 'getAdminActiveContainers']);
Route::get('/user-by-warehouse/{warehouse_id}', [CustomerController::class, 'getUsersByWarehouse']);
Route::get('/container-by-warehouse/{warehouse_id}', [CustomerController::class, 'getVehiclesByWarehouse']);
Route::get('/dashboard-stats', [DashboardController::class, 'getDashboardStats']);


//Order Status Manage Apis
Route::post('/get-drivers-by-assign-status', [OrderStatusManage::class, 'getDriversByParcelId']);
Route::post('/fetch-transfer-to-hub-data', [OrderStatusManage::class, 'fetchTransferToHubData']);
Route::post('/get-delivery-drivers-by-assign-status', [OrderStatusManage::class, 'getDeliveryDriversByParcelId']);

Route::post(uri: '/update-status-pick-up-with-driver', action: [OrderStatusManage::class, 'statusUpdate_PickUpWithDriver']);
Route::post(uri: '/update-status-arrived-warehouse', action: [OrderStatusManage::class, 'statusUpdate_ArrivedWarehouse']);
Route::post('/update-status-transfer-to-hub', [OrderStatusManage::class, 'statusUpdate_transferToHub']);
Route::post('/update-status-received-to-hub', [OrderStatusManage::class, 'statusUpdate_receivedToHub']);
Route::post(uri: '/update-status-fully-loaded-container', action: [OrderStatusManage::class, 'statusUpdate_fullyloadedcontainer']);
Route::post(uri: '/update-status-fully-discharge-container', action: [OrderStatusManage::class, 'statusUpdate_fullydischargecontainer']);
Route::post(uri: '/update-status-delivery-with-driver', action: [OrderStatusManage::class, 'statusUpdate_DeliveryWithDriver']);
Route::post(uri: '/update-status-signature-self-delivery', action: [OrderStatusManage::class, 'statusUpdate_SignatureSelfDelivery']);
Route::post('/update-status-admin-cancel', [OrderStatusManage::class, 'statusUpdateAdmin_Cancel']);
Route::post('/update-status-admin-reschedule', [OrderStatusManage::class, 'statusUpdateAdmin_reschedule']);

// Pickup
Route::get('/pickup-users/{id}', [PickupController::class, 'getPickupUsers']);
Route::post('/pickup-address', [PickupController::class, 'CreatePickupAddress']);


// Ship to
Route::post('/shipto-address', [ShiptoController::class, 'CreateShipTo']);
Route::get('/ship-to-users/{id}', [ShiptoController::class, 'getShipToUsers']);

// Container 
Route::post('/update-in-container-time', [ContainerController::class, 'updateContainerInDateTime']);
Route::post('/update-out-container-time', [ContainerController::class, 'updateContainerOutDateTime']);

//CBM 
Route::get('/default-container-sizes', [CBMCalculatoarController::class, 'getDefaultContainerSizes'])->name('default.container.sizes');
Route::get('/get-ports/{country}', [CBMCalculatoarController::class, 'getPortsByCountryName']);
Route::get('/port-freight-containers/{id}', [CBMCalculatoarController::class, 'getContainersByPortFreightId']);
Route::delete('/port-freight-delete/{id}', [CBMCalculatoarController::class, 'destroyPortFreight']);
Route::post('/get-freight-data-shipping', [CBMCalculatoarController::class, 'getFreightShippingData']);
Route::post('/store-single-shipping-container-product', [CBMCalculatoarController::class, 'storeContainerAndProduct']);
Route::delete('/delete-container-product/{id}', [CBMCalculatoarController::class, 'deleteContainerProduct']);


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
    Route::get('/deletUsers', [ProfileController::class, 'deletUsers']);




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
        Route::get('/customers-list-invoice', [CustomerController::class, 'getCustomersInvoice']);
        Route::get('/customers-list-driver', [CustomerController::class, 'getCustomersDriver']);

        Route::post('/create-customer', [CustomerController::class, 'createCustomer']);
        Route::post('/create-shipping-customer', [CustomerController::class, 'createShippingCustomer']);
        Route::get('/shipping-customer-list/{id}', [CustomerController::class, 'ShippingCustomerList']);
        // Container Routes
        Route::get('/container-list', [ContainerController::class, 'getActiveContainers']);
        Route::apiResource('cart', CartController::class);
        Route::post('/productList', [CartController::class, 'productList']);
        Route::post('/delete-product', [CartController::class, 'destroyProduct']);

        // Address Routes
        Route::post('/address-list', [AddressController::class, 'getAddress']);
        Route::get('/address-details/{id}', [AddressController::class, 'getAddressById']);
        Route::post('/addresse-create', [AddressController::class, 'createAddress']);
        Route::get('/addresse-delete/{id}', [AddressController::class, 'deleteAddress']);
        Route::post('/address-update/{id}', [AddressController::class, 'updateAddress']);

        // item Routes
        Route::get('/get-items', [InventoryController::class, 'getItems']);

        // Order shipment Routes
        Route::post('/invoice-order-create-service', [OrderShipmentController::class, 'invoiceOrderCreateService']);
        Route::post('/invoice-order-create-supply', [OrderShipmentController::class, 'invoiceOrderCreateSupply']);
        Route::post('/order-create-supply', [OrderShipmentController::class, 'storeSupply']);
        Route::post('/parcel-pickup-driver', [OrderShipmentController::class, 'parcelPickupDriver']);

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
        Route::get('/location-get', [AvailabilityController::class, 'locationGet']);
        Route::post('/location-delete', [AvailabilityController::class, 'locationGet']);
        // Service Order Status Manage Driver
        Route::post('/get-driver-all-orders-list', [ServiceOrderStatusManage::class, 'getDriverAllOrders']);
        Route::get('/get-driver-service-orders-details/{id}', [ServiceOrderStatusManage::class, 'getDriverServiceOrderDetails']);
        Route::post('/update-status-pick-up', [ServiceOrderStatusManage::class, 'statusUpdate_PickUp']);
        Route::post('/update-status-delivery', [ServiceOrderStatusManage::class, 'statusUpdate_Delivery']);
        Route::post('/update-status-delivered', [ServiceOrderStatusManage::class, 'statusUpdate_Delivered']);
        Route::post('/update-status-cancel', [ServiceOrderStatusManage::class, 'statusUpdate_Cancel']);
        Route::post('/update-status-reschedule', [ServiceOrderStatusManage::class, 'statusUpdate_reschedule']);

        // Ship To mobile customer
        Route::post('/customer-shipto-create', [ShiptoController::class, 'CustomerCreateShipTo']);
        Route::post('/get-shipto-users', [ShiptoController::class, 'getCustomerShipToUsers']);
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
