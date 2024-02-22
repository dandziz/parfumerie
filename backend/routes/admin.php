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
    Route::patch('{perfume}', 'update');

    /* Images */
    Route::get('{perfume}/images', 'getImages');
    Route::post('{perfume}/images', 'addImages');
    Route::delete('{perfume}/{media}', 'deleteImage');
    Route::post('{perfume}/{media}/default', 'updateDefaultImage');
    Route::post('{perfume}/{media}/ml', 'updateDefaultMLImage');
    Route::post('{perfume}/{media}/fullbox', 'updateDefaultFullboxImage');
    Route::post('{perfume}/images/index', 'updateImageIndex');

    /* Prices */
    Route::get('{perfume}/prices', 'getPrices');
    Route::post('{perfume}/prices', 'addPrice');
    Route::patch('{perfume}/prices/{perfume_price}', 'updatePrice');
    Route::delete('{perfume}/prices/{perfume_price}', 'deletePrice');
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
