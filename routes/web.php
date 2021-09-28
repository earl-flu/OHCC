<?php

use App\Http\Controllers\Api\ActivityLogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HealthFacilityController;
use App\Http\Controllers\PatientController;
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
    return view('welcome');
});

// Route::get('/dashboard',[DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');;

Route::resource('patients', PatientController::class)->middleware('auth');

Route::resource('health-facilities', HealthFacilityController::class)->middleware('auth');

// API ROUTE
Route::prefix('api')->middleware('auth')->group(function () {
    Route::get('activities', [ActivityLogController::class, 'index']);
});

require __DIR__ . '/auth.php';
