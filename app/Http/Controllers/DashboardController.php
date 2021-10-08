<?php

namespace App\Http\Controllers;

use App\Models\HealthFacility;
use App\Models\Municipality;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->healthFacility) {
            $healthfacility = HealthFacility::findOrFail($user->healthFacility->id);
            return view('dashboard', compact('healthfacility'));
        }
        $municipalities = Municipality::all();
        return view('dashboard', compact('municipalities'));
    }
}
