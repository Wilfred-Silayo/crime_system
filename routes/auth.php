<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\DashboardController;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store');

    Route::get('register', [RegistrationController::class, 'create'])
    ->name('register');

    Route::post('register', [RegistrationController::class, 'store'])
    ->name('register.store');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard',[DashboardController::class,'index'])
    ->name('dashboard');

    Route::get('password/edit', [PasswordController::class, 'edit'])
    ->name('password.edit');

    Route::put('password/update', [PasswordController::class, 'update'])
    ->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
});