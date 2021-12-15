<?php

use App\Http\Controllers\Api\ActivityLogController;
use App\Http\Controllers\Api\HealthFacilityController as ApiHealthFacilityController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\MunicipalitiesController;
use App\Http\Controllers\Api\SuperAdminHistoryController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HealthFacilityController;
use App\Http\Controllers\HistoryController as ControllersHistoryController;
use App\Http\Controllers\NotificationController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::resource('patients', PatientController::class); // hindi na muna gagamitin dahil nag bago ang plano nila
    Route::get('/health-facilities/{health_facility}/edit-capacity', [HealthFacilityController::class, 'editCapacity'])
        ->name('edit.capacity');
    Route::put('/health-facilities/{health_facility}/edit-capacity', [HealthFacilityController::class, 'updateCapacity'])
        ->name('update.capacity');
    Route::resource('health-facilities', HealthFacilityController::class);

    Route::get('account', [ChangePasswordController::class, 'index'])->name('edit.account');
    Route::post('change-password', [ChangePasswordController::class, 'changePassword'])->name('change.password');

    Route::get('/update-by-date', [ControllersHistoryController::class, 'index'])->name('update-by-date');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
});

// API ROUTE
Route::prefix('api')->middleware('auth')->group(function () {
    Route::get('municipalities', [MunicipalitiesController::class, 'index']);
    Route::get('activities', [ActivityLogController::class, 'index']);
    Route::get('histories', [HistoryController::class, 'index']);
    Route::get('superadmin/histories', [SuperAdminHistoryController::class, 'index']);
    Route::get('health-facilities', [ApiHealthFacilityController::class, 'index']);
});

require __DIR__ . '/auth.php';
