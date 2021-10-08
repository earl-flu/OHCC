<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HealthFacilityResource;
use App\Http\Resources\MunicipalityResource;
use App\Models\HealthFacility;
use App\Models\Municipality;
use Illuminate\Http\Request;

class MunicipalitiesController extends Controller
{
    public function index(Request $request)
    {   
        $municipalities = Municipality::with('healthFacilities')->get();
        return MunicipalityResource::collection($municipalities);
        // $health_facilities = HealthFacility::with('municipality')->get();
        // return HealthFacilityResource::collection($health_facilities);
    }
}
