<?php
// Rescaffold authentication routes

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::get('login', LoginController::class . '@showLoginForm')->name('login');
Route::post('login', LoginController::class . '@login');
Route::post('logout', LoginController::class . '@logout')->name('logout');

if (env('CAN_REGISTER')) {
    Route::get('register', RegisterController::class . '@showRegistrationForm')->name('register');
    Route::post('register', RegisterController::class . '@register');
}

// Password Reset Routes...
Route::get('password/reset', ForgotPasswordController::class . '@showLinkRequestForm')->name('password.request');
Route::post('password/email', ForgotPasswordController::class . '@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', ResetPasswordController::class . '@showResetForm')->name('password.reset');
Route::post('password/reset', ResetPasswordController::class . '@reset')->name('password.update');
