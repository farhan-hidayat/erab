<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// User
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    // Route::resource('users', UserController::class);
    // Route::resource('faculties', FacultyController::class);
    // Route::resource('activities', ActivityController::class);
});

// Admin
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin'
])->group(function () {
    // Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('faculties', FacultyController::class);
    Route::resource('activities', ActivityController::class);
    Route::resource('classifications', ClassificationController::class);
    Route::resource('details', DetailController::class);
});
