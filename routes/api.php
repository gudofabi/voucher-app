<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VoucherController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1'], function () {
    
    Route::apiResource('/vouchers', VoucherController::class);
    
    Route::get('/me', [AuthController::class, 'me']);

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::delete('/logout', [AuthController::class, 'logout']);



    Route::middleware(['regular'])->group(function() {

    });

    Route::middleware(['groupadmin'])->group(function() {

    });
    
    Route::middleware(['superadmin'])->group(function() {

    });


});
