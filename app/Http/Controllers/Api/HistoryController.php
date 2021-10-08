<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HistoryResource;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        // Specific Data of Health Facility Based on User
        $user = Auth::user();

        // Filter the healthfacility based on date query string
        $startDate = $request->query('_startDate');
        $endDate = $request->query('_endDate');

        //if dates are not set, return
        if (!$startDate && !$endDate) return;

        $histories = History::where('health_facility_id', $user->healthFacility->id)
            ->where('log_name', 'updated_occupied')
            //     // yyyy-mm-dd
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->orderBy('created_at', 'desc')
            ->get();

        return HistoryResource::collection($histories);
    }
}
