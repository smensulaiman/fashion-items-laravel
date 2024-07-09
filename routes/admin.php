<?php
/**
 * Admin Routes
 */

use App\Http\Controllers\Backend\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('admin/dashboard', array(AdminController::class, 'dashboard'))
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');
