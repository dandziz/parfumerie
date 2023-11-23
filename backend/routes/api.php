<?php

use App\Http\Controllers\Customer\Auth\AuthController;
use App\Http\Controllers\Customer\User\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function() {
    Route::post('login', 'login');
});

Route::middleware('auth:api')->controller(AuthController::class)->group(function() {
    Route::get('logout', 'logout');
});

Route::middleware('auth:api')->controller(UserController::class)->group(function() {
    Route::get('profile-details', 'getUserDetail');
});

