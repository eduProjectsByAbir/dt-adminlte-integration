<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Artisan;


Auth::routes();

// Admin Controller
Route::middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('/');
    Route::get('/home', [AdminController::class, 'index'])->name('home');
    Route::get('/starter', [AdminController::class, 'starter'])->name('starter');
    // Profile Routes
    Route::get('/profile/{id}', [AdminProfileController::class, 'index'])->name('profile.view');
    Route::get('/profile/edit/{id}', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update/{id}', [AdminProfileController::class, 'update'])->name('profile.update');
    // Students Routes
    Route::resources([
        'students' => StudentController::class,
    ]);

});

// clear-all-from-web
Route::get("clear", function (){
    Artisan::call("cache:clear");
    Artisan::call('optimize');
    Artisan::call('route:cache');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    dd("all-clear");
});
