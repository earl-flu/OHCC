<?php

use App\Http\Controllers\Api\HealthFacilityController;
use App\Http\Resources\HospitalResource;
use App\Models\HealthFacility;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/hospitals', function () {
    return HospitalResource::collection(HealthFacility::with('municipality')->get());
});


