<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Auth::routes();

// Admin Controller
Route::middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('/');
    Route::get('/home', [AdminController::class, 'index'])->name('home');
    Route::get('/starter', [AdminController::class, 'starter'])->name('starter');
});
