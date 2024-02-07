<?php

use App\Http\Controllers\Auth\VerificationApiController;
use App\Http\Controllers\Server\ServerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('api/email/verify/{id}/{hash}', [VerificationApiController::class, 'verify'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.api.verify');
Route::get('/email-activation', [ServerController::class, 'index']);
