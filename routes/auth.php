<?php

use App\Http\Controllers\auth\ForgetController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

route::name('auth.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [LoginController::class, 'index'])->name('login.index');
        Route::post('login', [LoginController::class, 'store'])->name('login.store');
        Route::get('register', [RegisterController::class, 'index'])->name('register.index');
        Route::post('register', [RegisterController::class, 'store'])->name('register.store');
        Route::get('forget', [ForgetController::class, 'index'])->name('forget.index');
        Route::get('reset-password', [ResetPasswordController::class, 'index'])->name('reset-password.index');
    });
    Route::middleware('auth')->group(function () {
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    });
});
