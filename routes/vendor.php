<?php
/**
 * Admin Routes
 */

use App\Http\Controllers\Backend\VendorController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', array(VendorController::class, 'dashboard'))
    ->name('dashboard');
