<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', array(HomeController::class, "index"))->name('home');
Route::post('/home', array(HomeController::class, "chamari"))->name('home');
