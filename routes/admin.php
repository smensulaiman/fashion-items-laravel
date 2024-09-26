<?php
/**
 * Admin Routes
 */

use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\Admin\CategoryController;
use App\Http\Controllers\Backend\Admin\ProfileController;
use App\Http\Controllers\Backend\Admin\SliderController;
use App\Http\Controllers\Backend\Admin\SubCategoryController;
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

/* Sub Category */
Route::resource('sub-category', SubCategoryController::class);
