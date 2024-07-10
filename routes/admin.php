<?php
/**
 * Admin Routes
 */

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', array(AdminController::class, 'dashboard'))
    ->name('dashboard');


/* Profile */
Route::get('profile', array(ProfileController::class, 'edit'))
    ->name('profile');
Route::post('profile', array(ProfileController::class, 'update'))
    ->name('profile.update');
