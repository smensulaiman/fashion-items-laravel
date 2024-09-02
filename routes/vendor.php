<?php
/**
 * Admin Routes
 */

use App\Http\Controllers\Backend\vendor\VendorController;
use App\Http\Controllers\Backend\vendor\VendorProfileController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', array(VendorController::class, 'dashboard'))
    ->name('dashboard');

Route::get('profile', array(VendorProfileController::class, 'index'))
    ->name('profile');

Route::put('profile', array(VendorProfileController::class, 'updateProfile'))
    ->name('profile.update');

Route::put('profile/password', array(VendorProfileController::class, 'updatePassword'))
    ->name('profile.password.update');
