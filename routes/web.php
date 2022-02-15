<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomeController;

Route::get('/', [HomeController::class, 'index'])->name('/');

Auth::routes([
    'verify' => true
]);

// Admin Controller
Route::middleware(['auth', 'verified', 'isAdmin'])->group(function () {
    // dashboard routes
    Route::get('/home', [AdminController::class, 'index'])->name('home');
    Route::get('/starter', [AdminController::class, 'starter'])->name('starter');

    // Profile Routes
    Route::resource('profile', AdminProfileController::class)->only('index', 'edit', 'update' );

    // Students Routes
    Route::resources([
        '/students' => StudentController::class,
    ], ['except' => 'show']);

    // Ajax Calling data
    Route::post('/expense/income/data',[IncomeController::class, 'comparisonData']);

    // Export Routes
    Route::get('export-data', [ExportController::class, 'index']);
    Route::post('export-data/students', [ExportController::class, 'getStudentReportType'])->name('export-student-data');

});

// User Route
Route::middleware(['auth', 'verified', 'isUser'])->prefix('/user')->name('user.')->group(function () {
    // index route
    Route::get('/home', [UserController::class, 'index'])->name('home');

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
