<?php
/**
 * Admin Routes
 */

use App\Http\Controllers\Backend\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', array(AdminController::class, 'dashboard'))
    ->name('dashboard');
