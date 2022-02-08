<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Artisan;


Auth::routes();

// Admin Controller
Route::middleware(['auth'])->group(function () {
    // dashboard routes
    Route::get('/', [AdminController::class, 'index'])->name('/');
    Route::get('/home', [AdminController::class, 'index'])->name('home');
    Route::get('/starter', [AdminController::class, 'starter'])->name('starter');

    // Profile Routes
    Route::resource('profile', AdminProfileController::class)->only('index', 'edit', 'update' );

    // Students Routes
    Route::resources([
        '/students' => StudentController::class,
    ], ['except' => 'show']);

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
