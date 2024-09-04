<?php
/**
 * Admin Routes
 */

use App\Http\Controllers\Backend\admin\AdminController;
use App\Http\Controllers\Backend\admin\CategoryController;
use App\Http\Controllers\Backend\admin\ProfileController;
use App\Http\Controllers\Backend\admin\SliderController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', array(AdminController::class, 'dashboard'))
    ->name('dashboard');


/* Profile */
Route::get('profile', array(ProfileController::class, 'edit'))
    ->name('profile');
Route::post('profile/update', array(ProfileController::class, 'update'))
    ->name('profile.update');
Route::post('profile/update/password', array(ProfileController::class, 'updatePassword'))
    ->name('profile.update.password');

/* Slider */
Route::resource('slider', SliderController::class);

/* Category */
Route::resource('category', CategoryController::class);
