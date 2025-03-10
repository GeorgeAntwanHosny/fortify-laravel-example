<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProfilePhotoController;
use  Laravel\Fortify\Http\Controllers\{AuthenticatedSessionController, PasswordController, RegisteredUserController,PasswordResetLinkController, ProfileInformationController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::group(['middleware' => 'auth:sanctum'], function() {

    // Authentication routes 
    Route::prefix('auth')->group(function () {

        // Retrieve the verification limiter configuration for verification attempts
        $verificationLimiter = config('fortify.limiters.verification', '6,1');

        Route::withoutMiddleware('auth:sanctum')->group(function () {
            // Retrieve the limiter configuration for login attempts
            $limiter = config('fortify.limiters.login');

            Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware(array_filter([
                    'guest:'.config('fortify.guard'),  // Only guests (non-authenticated users) are allowed
                    $limiter ? 'throttle:'.$limiter : null,  // Throttle login attempts if limiter is configured
                ]));

            // Route for user registration
            Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest:'.config('fortify.guard'));  // Only guests (non-authenticated users) are allowed
        });
        Route::post('/logout', [LogoutController::class, 'destroy']);
         
    });

    
    Route::prefix('user')->group(function () {
        Route::get('/', function (Request $request) {
            return $request->user();  
        });
        Route::put('/profile-information', [ProfileInformationController::class, 'update']);
        Route::post('/profile-photo', [ProfilePhotoController::class, 'update']);

        Route::post('/remove-photo', [ProfilePhotoController::class, 'delete']);

        Route::put('/update-password', [PasswordController::class, 'update']);
    });

});