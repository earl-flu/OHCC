<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HealthFacilityResource;
use App\Models\HealthFacility;
use Illuminate\Http\Request;

class HealthFacilityController extends Controller
{
    public function index(Request $request)
    {   
        $health_facilities = HealthFacility::with('municipality')->get();
        return HealthFacilityResource::collection($health_facilities);
    }
}
