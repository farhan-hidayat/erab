<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RabComboboxController;
use App\Http\Controllers\RabController;
use App\Http\Controllers\RabRequestController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\RpdController;
use App\Http\Controllers\SubComponentController;
use App\Http\Controllers\TypeController;
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
    Route::resource('subs', SubComponentController::class);
    Route::resource('programs', ProgramController::class);
    Route::resource('rabs', RabController::class);
    Route::resource('requests', RabRequestController::class);
    Route::get('get-classifications/{activityId}', [RabComboboxController::class, 'getClassificationsByActivity']);
    Route::get('get-details/{classificationId}', [RabComboboxController::class, 'getDetailsByClassification']);
    Route::get('get-components/{detailId}', [RabComboboxController::class, 'getComponentsByDetail']);
    Route::get('get-sub-components/{componentId}', [RabComboboxController::class, 'getSubByComponent']);
    Route::get('get-groups/{resourceId}', [RabComboboxController::class, 'getGroupsByResource']);
    Route::get('get-types/{groupId}', [RabComboboxController::class, 'getTypesByGroup']);
    Route::resource('rpds', RpdController::class);
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
    Route::resource('components', ComponentController::class);
    Route::resource('resources', ResourceController::class);
    Route::resource('groups', GroupController::class);
    Route::resource('types', TypeController::class);
    Route::get('cetak-rab/{rabId}', [DashboardController::class, 'cetak_pdf'])->name('cetak-rab');
});
