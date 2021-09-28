<?php

namespace App\Http\Controllers;

use App\Models\HealthFacility;
use App\Models\Municipality;
use App\Models\Patient;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        //create foreign key for municipalities
        $municipalities = Municipality::all();
        $hospitals = HealthFacility::all();
        $selected_municipality = $request->municipality;
        $selected_type = $request->type;

        //REFACTOR/OPTIMIZE THIS CODE
        //filter by municipality
        if ($selected_municipality) {
            if ($selected_municipality === "all") {
                $hospitals = $hospitals;
            } else {
                $hospitals = $hospitals->filter(function ($hospital) use ($selected_municipality) {
                    return $hospital->municipality->code == $selected_municipality;
                });
            }
        }

        // filter by type
        if ($selected_type) {
            if ($selected_type === "all") {
                $hospitals = $hospitals;
            } else {
                $hospitals = $hospitals->filter(function ($hospital) use ($selected_type) {
                    if ($selected_type === "hospital") {
                        return $hospital->is_isolation_facility == 0;
                    }
                    if ($selected_type === "isolation") {
                        return $hospital->is_isolation_facility == 1;
                    }
                });
            }
        }
   
        //Get total 
        $municipality_total = HealthFacility::MunicipalityBedTotalCapacity();
        // dd($municipality_total);

        return view('dashboard', compact('hospitals', 'municipalities', 'selected_municipality', 'selected_type'));
    }
}
