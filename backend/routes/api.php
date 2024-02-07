<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\VerificationApiController;
use App\Http\Controllers\Customer\User\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
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

Route::middleware(['auth:api', 'verified.api', 'active.api'])->controller(UserController::class)->group(function() {
    Route::get('profile-details', 'getUserDetail');
});

Route::get('send-mail', [UserController::class, 'sendMail']);
Route::post('email/resend', [VerificationApiController::class, 'resend'])->name('api.verification.resend');
