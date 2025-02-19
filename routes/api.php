<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    RegisterController,
    ForgetPassword,
    ProfileController
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
  
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
Route::post('forgetPassword', [ForgetPassword::class, 'forgetPassword']);

Route::middleware('auth:api')->group( function () {
    Route::post('logout', [RegisterController::class, 'logout']);
    Route::post('verifyOtp', [RegisterController::class, 'verifyOtp']);
    Route::post('resendOtp', [RegisterController::class, 'resendOtp']);
    Route::post('restPassword', [ForgetPassword::class, 'restPassword']);

    Route::middleware('apiAuthCheck')->group(function(){
        Route::get('/profile', [ProfileController::class, 'profile']);
        Route::post('profileUpdate', [ProfileController::class,'update']);
        Route::apiResource('OrderShipment', OrderShipmentController::class);
        Route::put('OrderShipmentStatus', [OrderShipmentController::class,'OrderShipmentStatus']);
        Route::get('OrderHistory/{id}', [OrderShipmentController::class,'OrderHistory']);
        Route::get('inventoryOrderCategories', [OrderShipmentController::class,'inventoryOrderCategories']);
        Route::post('changePassword', [ProfileController::class, 'changePassword']);
    });
});
