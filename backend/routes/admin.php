<?php

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

use App\Http\Controllers\Admin\BrandController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api', 'manage'])->controller(BrandController::class)->group(function() {
    Route::get('brands', 'index');
    Route::post('brands', 'store');
    Route::get('brands/{brand}', 'show');
    Route::put('brands/{brand}', 'update');
});

Route::middleware(['auth:api', 'admin'])->group(function () {
   Route::delete('/brands/{brand}', [BrandController::class, 'destroy']);
});
