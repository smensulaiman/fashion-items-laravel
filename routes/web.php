<?php

use App\Http\Controllers\Backend\admin\AdminController;
use App\Http\Controllers\Backend\admin\ProfileController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', array(HomeController::class, 'index'))
    ->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');

Route::group(array('prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth', 'verified']), function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'] )->name('dashboard');
});
