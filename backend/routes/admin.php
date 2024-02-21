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
use App\Http\Controllers\Admin\PerfumeController;
use App\Http\Controllers\Admin\SupplierController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api', 'manage'])->controller(BrandController::class)
    ->prefix('brands')->group(function() {
    Route::get('', 'index');
    Route::post('', 'store');
    Route::get('{brand}', 'show');
    Route::put('{brand}', 'update');
});

Route::middleware(['auth:api', 'manage'])->controller(PerfumeController::class)
    ->prefix('perfumes')->group(function() {
    Route::get('', 'index');
    Route::middleware('convertGenderToInt')->post('', 'store');
    Route::get('{perfume}', 'show');
    Route::put('{perfume}', 'update');
    Route::get('{perfume}/images', 'getImages');
    Route::post('{perfume}/images', 'addImages');
    Route::middleware('retrieve.image')->group(function() {
        Route::delete('{perfume}/{imageId}', 'deleteImage');
        Route::post('{perfume}/{imageId}/default', 'updateDefaultImage');
        Route::post('{perfume}/{imageId}/ml', 'updateDefaultMLImage');
        Route::post('{perfume}/{imageId}/fullbox', 'updateDefaultFullboxImage');
    });
    Route::post('{perfume}/images/index', 'updateImageIndex');
});

Route::middleware(['auth:api', 'manage'])->controller(SupplierController::class)
    ->prefix('suppliers')->group(function() {
    Route::get('', 'index');
    Route::get('all', 'getAllSuppliers');
    Route::post('', 'store');
    Route::get('{supplier}', 'show');
    Route::put('{supplier}', 'update');
});

Route::middleware(['auth:api', 'admin'])->group(function () {
   Route::delete('/brands/{brand}', [BrandController::class, 'destroy']);
});
