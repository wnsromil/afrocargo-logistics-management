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
    InvoiceController
};
use App\Http\Controllers\Api\{
    LocationController,
    OrderShipmentController,
    ProductController
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


Route::middleware('auth:api')->group(function () {
    Route::post('logout', [RegisterController::class, 'logout']);
    Route::post('verifyOtp', [RegisterController::class, 'verifyOtp']);
    Route::post('resendOtp', [RegisterController::class, 'resendOtp']);
    Route::post('resetPassword', [ForgetPassword::class, 'resetPassword']);

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

    });

    //invoice controller
    Route::group(['middleware' => 'apiAuthCheck','prefix' => 'invoice','as' => 'invoice.','controller' => InvoiceController::class], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create');
        Route::post('/store', 'store');
        Route::get('/supply', 'inventaries');

    });
});
