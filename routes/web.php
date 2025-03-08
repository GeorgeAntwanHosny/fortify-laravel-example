<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwoFactorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/recover-code', function () {
    return view('auth.two-factor-recover');
})->name('recover-code');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [ProfileController::class, 'show'])
        ->name('profile.show');
    Route::get('/user/profile/password', [ProfileController::class, 'showPasswordForm'])
        ->name('profile.show-password');
    Route::get('/user/two-factor-authentication', [TwoFactorController::class, 'show'])
        ->name('two-factor.show');
});
