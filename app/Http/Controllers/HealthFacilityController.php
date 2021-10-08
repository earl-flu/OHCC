<?php

namespace App\Http\Controllers;

use App\Models\HealthFacility;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class HealthFacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        abort(404); // hindi muna gagamitin dahil nagbago ang plano nila

        $user = Auth::user();
        if (!$user->isSuperAdmin()) {
            abort(403);
        };

        $health_facilities = HealthFacility::orderBy('name', 'desc');

        if ($request->filled('name_search')) {
            //returns builder
            $health_facilities = HealthFacility::nameSearch($request->get('name_search'));
        }

        if ($request->filled('type')) {
            $type = $request->get('type');

            //if all then same hospital
            $type == "all" ? $health_facilities = $health_facilities : "";

            //if hospital filter to hospital
            $type == "hospital" ? $health_facilities = $health_facilities->where('is_isolation_facility', 0) : "";

            //if isolation filter to isolation
            $type == "isolation" ? $health_facilities = $health_facilities->where('is_isolation_facility', 1) : "";
        }

        $health_facilities = $health_facilities->paginate(10);

        return view('health_facilities.index', compact('health_facilities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HealthFacility $healthfacility
     * @return \Illuminate\Http\Response
     */
    public function show(HealthFacility $health_facility)
    {
        //
    }

    /**
     *  Edit page - Health Facility
     *
     * @param  \App\Models\HealthFacility $health_facility
     * @return \Illuminate\Http\Response
     */
    public function edit(HealthFacility $health_facility, Request $request)
    {
        $user = Auth::user();

        if (!$user->isSuperAdmin() && $user->healthFacility->id !== $health_facility->id) { // && !$user->isVaccinationAdmin()
            abort(403);
        };

        $activities = Activity::where('subject_id', $health_facility->id)
            ->where('log_name', 'health_facility_log')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $histories = History::where('log_name', HealthFacility::UPDATE_OCCUPIED)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('health_facilities.edit', compact('health_facility', 'activities', 'histories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HealthFacility $health_facility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HealthFacility $health_facility)
    {
        $user_id = Auth::user()->id;

        $validated = $request->validate([
            "occupied_ward" => "required|integer",
            "occupied_isolation" => "required|integer",
            "occupied_icu" => "required|integer",
        ]);
        $validated['updated_at'] = now();

        $health_facility->update($validated);

        $health_facility
            ->writeHistoryOccupied($user_id, $health_facility, HealthFacility::UPDATE_OCCUPIED);

        return redirect()->route('health-facilities.edit', $health_facility)->with('success', $health_facility->name . ' successfully updated!');
    }

    // Edit page - Health Facility Capacity
    public function editCapacity(HealthFacility $health_facility, Request $request)
    {
        $user = Auth::user();

        if (!$user->isSuperAdmin() && $user->healthFacility->id !== $health_facility->id) { // && !$user->isVaccinationAdmin()
            abort(403);
        };

        return view('health_facilities.edit-capacity', compact('health_facility'));
    }

    public function updateCapacity(Request $request, HealthFacility $health_facility)
    {
        $user_id = Auth::user()->id;
        // dd($user_id);
        $validated = $request->validate([
            "ward_capacity" => "required|integer",
            "isolation_capacity" => "required|integer",
            "icu_capacity" => "required|integer",
            "max_ventilator" => "required|integer",
        ]);

        $health_facility->update($validated);

        $health_facility
            ->writeHistoryCapacity($user_id, $health_facility, HealthFacility::UPDATE_CAPACITY);

        return redirect()->route('edit.capacity', $health_facility)->with('success', $health_facility->name . ' capacity is successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HealthFacility $health_facility
     * @return \Illuminate\Http\Response
     */
    public function destroy(HealthFacility $health_facility)
    {
        //
    }
}
