<?php

use Illuminate\Support\Facades\Route;
use JewelRana\PasswordPolicy\Http\Controllers\ResetPasswordController;

Route::middleware('web')->group(function () {
    Route::middleware('auth')->prefix('password')->group(function () {
        Route::get('standard/reset', [ResetPasswordController::class, 'resetForm'])->name('password-policy.form');
        Route::post('standard/reset', [ResetPasswordController::class, 'resetPassword'])->name('password-policy.reset');
    });
});
