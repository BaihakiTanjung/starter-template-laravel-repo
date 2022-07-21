<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Api\ReferralController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Version 1
Route::prefix('v1')->group(function () {
    //API route for register new user
    Route::post('/register', [AuthController::class, 'register']);

    // Referral
    Route::prefix('referral')->group(function () {
        Route::post('/register', [ReferralController::class, 'register']);
        Route::post('/verify-otp', [ReferralController::class, 'verifyOtp']);
    });
    // End Referral

    //API route for login user
    Route::post('/login', [AuthController::class, 'login']);

    Route::prefix('otp')->group(function () {
        Route::post('/send', [AuthController::class, 'sendOtp']);
        Route::post('/verify', [AuthController::class, 'verifyOtp']);
    });

    Route::prefix('forgot-password')->group(function () {
        Route::post('/', [AuthController::class, 'forgotPassword']);
        Route::post('/verify', [AuthController::class, 'verifyForgotPassword']);
        Route::post('/reset-password', [AuthController::class, 'resetPassword']);
    });

    //Protecting Routes
    Route::group(['middleware' => ['auth:sanctum']], function () {

        Route::prefix('profile')->group(function () {
            Route::get('/', [AuthController::class, 'profile']);
            Route::post('/change-password', [AuthController::class, 'changePassword']);
        });

        Route::get('/user/{id}', [UserController::class, 'findUserId']);

        // API route for logout user
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

// Using api to clear cache, cookies, and sessions
Route::get('/clear', function () {
    Artisan::call('optimize:clear');
    return Artisan::output();
});
