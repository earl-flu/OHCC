<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityLogResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        // Specific Data Health Facility Based on User
        $user = Auth::user();

        // If startDate and endDate is set then:
        // Filter the healthfacility based on date query string
        $startDate = $request->query('_startDate');
        $endDate = $request->query('_endDate');
        // dd($endDate);
        if ($startDate && $endDate) {
            $activities = Activity::where('subject_id', $user->health_facility_id)
                ->where([
                    ['log_name', 'health_facility_log'],
                    ['description', 'updated']
                ])
                // yyyy-mm-dd
                ->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate)
                ->orderBy('created_at', 'desc')
                ->get();

            return ActivityLogResource::collection($activities);
        }

    }
}
