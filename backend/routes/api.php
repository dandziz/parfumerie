<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\VerificationApiController;
use App\Http\Controllers\Customer\AddressController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| Here is where you can register User routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(HomeController::class)->group(function() {
    Route::get('brands', 'getAllBrands');
});

Route::controller(AuthController::class)->group(function() {
    Route::post('login', 'login');
    Route::post('logout', 'logout')->middleware(['auth:api']);
});


Route::middleware(['auth:api', 'verified.api', 'active.api'])->prefix('user')->group(function() {
    Route::controller(UserController::class)->group(function () {
        Route::get('profile-details', 'getUserDetail');
        Route::post('change-password', 'changePassword');
    });
    Route::controller(AddressController::class)->group(function () {
        Route::get('addresses', 'index');
        Route::get('addresses/count', 'getNumberOfAddresses');
        Route::post('addresses', 'store');
        Route::put('address/{id}', 'update');
        Route::delete('address/{id}', 'destroy');
    });
    Route::controller(OrderController::class)->group(function () {
        Route::get('orders', 'index');
    });
});

Route::post('email/resend', [VerificationApiController::class, 'resend'])->name('api.verification.resend');
